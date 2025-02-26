<?php

namespace App\Services;

use App\Contracts\StatsInterface;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class StatsPatientService implements StatsInterface
{
    public static function getStats(?string $startDate, ?string $endDate, array $labelWidgets): array
    {
        $stats = [];
        foreach ($labelWidgets as $typeLabelWidget => $labelWidget) {
            $stats[] = (Stat::make(
                label: $labelWidget,
                value: Patient::query()
                    ->where('type', $typeLabelWidget)
                    ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count(),
            ));
        }
        return $stats;
    }
}
