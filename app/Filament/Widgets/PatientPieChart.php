<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use App\Traits\InteractsWithDashboardFilters;
use Filament\Widgets\ChartWidget;

class PatientPieChart extends ChartWidget
{
    use InteractsWithDashboardFilters;

    protected static ?string $heading = 'Total patients';

    protected static ?string $maxHeight = '213px';

    protected function getData(): array
    {
        $data = Patient::getTotalPatientGroupByType($this->getStartDate(), $this->getEndDate());

        return [
            'datasets' => [
                [
                    'label' => 'Patients',
                    'data' => $data,
                    'backgroundColor' => [
                        '#3b82f6', // Bleu Filament (primary)
                        '#ef4444', // Rouge Filament (danger)
                        '#f59e0b', // Jaune Filament (warning)
                    ],
                ],
            ],
            'labels' => $this->getLabel($data),
        ];
    }

    protected function getLabel(array $data): array
    {
        $label = [];
        $typePatient = ['Cats', 'Dogs', 'Rabbits'];
        foreach ($data as $key => $value) {
            if ($value > 0) $label[] = $typePatient[$key];
        }
        return $label;
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
