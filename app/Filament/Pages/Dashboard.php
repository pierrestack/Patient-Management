<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestAppointment;
use App\Filament\Widgets\LatestPatient;
use App\Filament\Widgets\LatestTopAppointmentByPatient;
use App\Filament\Widgets\LatestTopOwnerByPatient;
use App\Filament\Widgets\PatientLineChart;
use App\Filament\Widgets\PatientPieChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\StatsOverviewAppointment;
use App\Filament\Widgets\StatsOverviewPatient;
use App\Filament\Widgets\TreatmentsBarChart;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class Dashboard extends BaseDashboard
{
    use HasFiltersAction;

    protected static string $view = 'filament.pages.custom-dashboard';

    public string $activeTab = 'overview';

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function getActiveTab(): string
    {
        return $this->activeTab;
    }

    public function getTabs(): array
    {
        return [
            'overview' => 'Overview',
            'patient' => 'Patient',
            'appointment' => 'Appointment',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make()
                ->form([
                    DatePicker::make('startDate')
                        ->label('Date start')
                        ->required()
                        ->minDate(now()->subYears(1))
                        ->maxDate(now())
                        ->default(now()->startOfYear()->toDateString()),
                    DatePicker::make('endDate')
                        ->label('Date end')
                        ->required()
                        ->minDate(now()->subYears(1))
                        ->maxDate(now())
                        ->default(now()->toDateString()),
                ])
                ->modalHeading('Filter results'),
        ];
    }

    public function getWidgets(): array
    {
        return match ($this->getActiveTab()) {
            'overview' => [
                StatsOverview::class,
                TreatmentsBarChart::class,
                LatestTopOwnerByPatient::class,
                LatestTopAppointmentByPatient::class
            ],
            'patient' => [
                StatsOverviewPatient::class,
                PatientLineChart::class,
                PatientPieChart::class,
                LatestPatient::class,
            ],
            'appointment' => [
                StatsOverviewAppointment::class,
                LatestAppointment::class,
            ]
        };
    }

    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }
}
