<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewPatient extends BaseWidget
{
    use InteractsWithDashboardFilters;

    protected function getStats(): array
    {
        return [
            Stat::make('Total cats', Patient::query()
                ->where('type', 'Cat')
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])->count())
                ->icon('heroicon-o-user'),

            Stat::make('Total dogs', Patient::query()
                ->where('type', 'Dog')
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])->count())
                ->icon('heroicon-o-user'),

            Stat::make('Total rabbits', Patient::query()
                ->where('type', 'Rabbit')
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])->count())
                ->icon('heroicon-o-user'),
        ];
    }
}
