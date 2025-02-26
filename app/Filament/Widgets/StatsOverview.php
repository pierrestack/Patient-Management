<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Patient;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithDashboardFilters;

    protected function getStats(): array
    {

        return [
            Stat::make('Total owners', Owner::query()
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-user-group'),

            Stat::make('Total patients', Patient::query()
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-user'),

            Stat::make('Total appointments', Appointment::query()
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-calendar'),
        ];
    }
}
