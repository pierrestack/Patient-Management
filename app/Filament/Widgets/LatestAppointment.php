<?php

namespace App\Filament\Widgets;

use App\Enums\StatusAppointment;
use App\Models\Appointment;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAppointment extends BaseWidget
{
    use InteractsWithDashboardFilters;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()]))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('patient.name'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => StatusAppointment::getStatusIcons($state))
                    ->color(fn(string $state): string => StatusAppointment::getStatusColors($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creation date')
                    ->dateTime()
            ]);
    }
}
