<?php

namespace App\Contracts;

interface StatsInterface
{
    public static function getStats(?string $startDate, ?string $endDate, array $labelWidgets): array;
}
