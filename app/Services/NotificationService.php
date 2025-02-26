<?php

namespace App\Services;

use Filament\Notifications\Notification;

class NotificationService
{
    public static function getSuccessNotification(string $title, string $body): ?Notification
    {
        return Notification::make()
            ->success()
            ->title($title)
            ->body($body);
    }
}
