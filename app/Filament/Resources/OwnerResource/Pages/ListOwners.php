<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use App\Filament\Resources\OwnerResource;
use App\Models\Owner;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab as ComponentsTab;
use Illuminate\Database\Eloquent\Builder;

class ListOwners extends ListRecords
{
    protected static string $resource = OwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => ComponentsTab::make(),
            'This week' => ComponentsTab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(Owner::query()->where('created_at', '>=', now()->subWeek())->count()),
            'This month' => ComponentsTab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Owner::query()->where('created_at', '>=', now()->subMonth())->count()),
            'This year' => ComponentsTab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Owner::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
