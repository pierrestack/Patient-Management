<?php

namespace App\Filament\Widgets;

use App\Models\Owner;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTopOwnerByPatient extends BaseWidget
{
    use InteractsWithDashboardFilters;

    public function getTableHeading(): string
    {
        return 'Top 10 owners';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Owner::query()->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()]))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Owner'),
                Tables\Columns\TextColumn::make('patients_count')
                    ->label('Total animals')
                    ->badge()
                    ->counts('patients'),
            ])
            ->defaultSort('patients_count', 'desc');
    }
}
