<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTopAppointmentByPatient extends BaseWidget
{
    use InteractsWithDashboardFilters;

    public function getTableHeading(): string
    {
        return 'Top 10 appointments';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query()->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()]))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Patient'),
                Tables\Columns\TextColumn::make('appointments_count')
                    ->label('Total appointment')
                    ->badge()
                    ->counts('appointments'),
            ])
            ->defaultSort('appointments_count', 'desc');
    }
}
