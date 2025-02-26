<?php

namespace App\Filament\Widgets;

use App\Enums\StatusAppointment;
use App\Models\Appointment;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewAppointment extends BaseWidget
{
    use InteractsWithDashboardFilters;

    protected function getStats(): array
    {
        return [
            Stat::make(StatusAppointment::Future->value, Appointment::query()
                ->where('status', StatusAppointment::Future->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-calendar-days'),

            Stat::make(StatusAppointment::InTheWaitingRoom->value, Appointment::query()
                ->where('status', StatusAppointment::InTheWaitingRoom->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-home'),

            Stat::make(StatusAppointment::InProgress->value, Appointment::query()
                ->where('status', StatusAppointment::InProgress->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-arrow-path'),

            Stat::make(StatusAppointment::Seen->value, Appointment::query()
                ->where('status', StatusAppointment::Seen->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-eye'),

            Stat::make(StatusAppointment::Canceled->value, Appointment::query()
                ->where('status', StatusAppointment::Canceled->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-x-mark'),

            Stat::make(StatusAppointment::NotHonored->value, Appointment::query()
                ->where('status', StatusAppointment::NotHonored->value)
                ->whereBetween('created_at', [$this->getStartDate(), $this->getEndDate()])
                ->count())
                ->icon('heroicon-o-archive-box-x-mark'),
        ];
    }
}
