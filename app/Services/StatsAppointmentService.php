<?php

namespace App\Services;

use App\Contracts\StatsInterface;
use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAppointmentService implements StatsInterface
{
    public static function getStats(?string $startDate, ?string $endDate, array $labelWidgets): array
    {
        $stats = [];
        $appointment = new Appointment();
        $listTotalAppointmentByPatientType = $appointment->getListTotalAppointmentByPatientType($startDate, $endDate);
        foreach ($labelWidgets as $typeLabelWidget => $labelWidget) {
            $stats[] = (Stat::make(
                label: $labelWidget,
                value: $appointment->getTotalAppointmentByPatientType($listTotalAppointmentByPatientType, $typeLabelWidget),
            ));
        }
        return $stats;
    }
}
