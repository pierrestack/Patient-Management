<?php

namespace App\Models;

use App\Services\FunctionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getListTotalAppointmentByPatientType(string $startDate, string $endDate): object
    {
        $count = DB::table('patients')
            ->join('appointments', 'patients.id', '=', 'appointments.patient_id')
            ->select('patients.type', DB::raw('COUNT(*) as total'))
            ->whereDate('appointments.created_at', '>=', $startDate)
            ->whereDate('appointments.created_at', '<=', $endDate)
            ->groupBy('patients.type')
            ->get();
        return $count;
    }

    public function getTotalAppointmentByPatientType(Collection $elements, string $label): int
    {
        $count = 0;
        foreach ($elements as $element) {
            if ($element->type == $label) {
                $count = $element->total;
            }
        }
        return $count;
    }

    public static function hasAppointmentToday(string $date, string $startTime, int $duration): bool
    {
        $endTime = FunctionService::calculateEndTime($startTime, $duration);

        $counter = DB::table('appointments')
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('time', [$startTime, $endTime]);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->whereRaw("TIME(DATE_ADD(time, INTERVAL duration MINUTE)) BETWEEN ? AND ?", [$startTime, $endTime]);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('time', '<=', $startTime)
                        ->whereRaw("TIME(DATE_ADD(time, INTERVAL duration MINUTE)) >= ?", [$endTime]);
                });
            })
            ->exists();

        return $counter;
    }

    public static function getLastAppointment(string $date, string $startTime, int $duration): ?array
    {
        $endTime = FunctionService::calculateEndTime($startTime, $duration);

        $lastAppointment = DB::table('appointments')
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('time', [$startTime, $endTime])
                    ->orWhereRaw("TIME(DATE_ADD(time, INTERVAL duration MINUTE)) BETWEEN ? AND ?", [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('time', '<=', $startTime)
                            ->whereRaw("TIME(DATE_ADD(time, INTERVAL duration MINUTE)) >= ?", [$endTime]);
                    });
            })
            ->orderByDesc('time')
            ->first(['time', DB::raw("TIME(DATE_ADD(time, INTERVAL duration MINUTE)) AS end_time")]);

        return $lastAppointment ? ['start_time' => $lastAppointment->time, 'end_time' => $lastAppointment->end_time] : null;
    }
}
