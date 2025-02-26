<?php

namespace App\Models;

use Filament\Panel\Concerns\HasNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{

    use HasNotifications, HasFactory;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public static function getPatientCountByMonth($year = null): array
    {
        $year = $year ?? date('Y');
        $patientCounts = array_fill(0, 12, 0);

        $results = self::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($results as $result) {
            $patientCounts[$result->month - 1] = $result->total;
        }

        return $patientCounts;
    }

    public static function getTotalPatientGroupByType(string $startDate, string $endDate): array
    {
        $totalPatientGroupByType = [];
        $results = self::select(
            'type',
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('type')
            ->orderBy('type', 'asc')
            ->get();

        foreach ($results as $result) {
            $totalPatientGroupByType[] = $result->total;
        }
        return $totalPatientGroupByType;
    }
}
