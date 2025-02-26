<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Components\Tab as ComponentsTab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

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
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date', '>=', now()->subWeek()))
                ->badge(Appointment::query()->where('date', '>=', now()->subWeek())->count()),
            'This month' => ComponentsTab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date', '>=', now()->subMonth()))
                ->badge(Appointment::query()->where('date', '>=', now()->subMonth())->count()),
            'This year' => ComponentsTab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date', '>=', now()->subYear()))
                ->badge(Appointment::query()->where('date', '>=', now()->subYear())->count()),
        ];
    }
}
