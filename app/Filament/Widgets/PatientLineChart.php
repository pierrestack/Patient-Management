<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;

class PatientLineChart extends ChartWidget
{
    protected static ?string $heading = 'Patients statistics';

    protected static string $color = 'primary';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Patients created',
                    'data' => Patient::getPatientCountByMonth(),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'fill' => true
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
