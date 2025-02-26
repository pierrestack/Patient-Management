<?php

namespace App\Services;

use App\Contracts\StatsInterface;

class StatsService
{
    private StatsInterface $statsInterface;

    public function __construct(StatsInterface $statsInterface)
    {
        $this->statsInterface = $statsInterface;
    }

    public function getStats(?string $startDate, ?string $endDate, array $labelWidgets): array
    {
        return $this->statsInterface->getStats($startDate, $endDate, $labelWidgets);
    }
}
