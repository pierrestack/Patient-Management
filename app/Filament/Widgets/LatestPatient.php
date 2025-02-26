<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPatient extends BaseWidget
{
    use InteractsWithDashboardFilters;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query()->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()]))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date(),
                Tables\Columns\TextColumn::make('owner.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
            ]);
    }
}
