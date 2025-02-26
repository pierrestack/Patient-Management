<?php

namespace App\Traits;

use Filament\Widgets\Concerns\InteractsWithPageFilters;

trait InteractsWithDashboardFilters
{
    use InteractsWithPageFilters;

    protected string $startDate;
    protected string $endDate;

    public function getStartDate(): string
    {
        $this->startDate = $this->filters['startDate'] ?? now()->startOfYear()->toDateString();
        return $this->startDate . ' 00:00:00';
    }

    public function getEndDate(): string
    {
        $this->endDate = $this->filters['endDate'] ?? now()->toDateString();
        return $this->endDate . ' 23:59:59';
    }
}
