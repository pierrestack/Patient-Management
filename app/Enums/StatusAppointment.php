<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatusAppointment: string implements HasLabel
{
    case Future = 'Future';
    case InTheWaitingRoom = 'In the waiting room';
    case InProgress = 'In progress';
    case Seen = 'Seen';
    case Canceled = 'Canceled';
    case NotHonored = 'Not honored';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Future => 'Future',
            self::InTheWaitingRoom => 'In the waiting room',
            self::InProgress => 'In progress',
            self::Seen => 'Seen',
            self::Canceled => 'Canceled',
            self::NotHonored => 'Not honored'
        };
    }

    public static function getStatusColors($state): string
    {
        return match ($state) {
            self::Future->value => 'primary',
            self::InTheWaitingRoom->value => 'success',
            self::InProgress->value => 'warning',
            self::Seen->value => 'indigo',
            self::Canceled->value => 'danger',
            self::NotHonored->value => 'gray'
        };
    }

    public static function getStatusIcons($state): string
    {
        return match ($state) {
            self::Future->value => 'heroicon-o-calendar-days',
            self::InTheWaitingRoom->value => 'heroicon-o-home',
            self::InProgress->value => 'heroicon-o-arrow-path',
            self::Seen->value => 'heroicon-o-eye',
            self::Canceled->value => 'heroicon-o-x-mark',
            self::NotHonored->value => 'heroicon-o-archive-box-x-mark'
        };
    }
}
