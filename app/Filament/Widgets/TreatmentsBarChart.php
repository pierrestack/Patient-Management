<?php

namespace App\Filament\Widgets;

use App\Models\Treatment;
use App\Traits\InteractsWithDashboardFilters;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TreatmentsBarChart extends ChartWidget
{
    use InteractsWithDashboardFilters;

    protected static ?string $heading = 'Treatment statistics';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::model(Treatment::class)
            ->between(
                start: Carbon::parse($this->getStartDate())->subYear(),
                end: Carbon::parse($this->getEndDate()),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Treatments',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
