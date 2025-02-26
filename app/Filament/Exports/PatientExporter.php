<?php

namespace App\Filament\Exports;

use App\Models\Patient;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;

class PatientExporter extends Exporter
{
    protected static ?string $model = Patient::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Name'),
            ExportColumn::make('date_of_birth')
                ->label('Date of birth'),
            ExportColumn::make('type'),
            ExportColumn::make('owner.name')
                ->label('Owner'),
            ExportColumn::make('appointments_count')
                ->label('Total appointment')
                ->counts([
                    'appointments' => fn(Builder $query) => $query->where('status', 'Seen'),
                ]),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your patient export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    // public function getFileName(Export $export): string
    // {
    //     return "patients-{$export->getKey()}.csv";
    // }
}
