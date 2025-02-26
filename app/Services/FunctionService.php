<?php

namespace App\Services;

class FunctionService
{
    public static function calculateAverage(int $sumTotal, int $currentSum): ?string
    {
        $sum = $currentSum * 100 / $sumTotal;
        return number_format($sum, 2);
    }

    public static function sumElementInArray(array $elements, int $start, int $end): int
    {
        $sumElement = 0;
        if ($start <= count($elements) && $end <= count($elements)) {
            for ($i = $start; $i <= $end; $i++) {
                $sumElement += $elements[$i];
            }
        }
        return $sumElement;
    }

    public static function calculateEndTime(string $startTime, int $duration): string
    {
        $startTimeTimestamp = strtotime($startTime);
        return date('H:i:s', $startTimeTimestamp + ($duration * 60));
    }

    public static function formatTimeToHoursMinutes(string $time): string
    {
        return date('H:i', strtotime($time));
    }
}
