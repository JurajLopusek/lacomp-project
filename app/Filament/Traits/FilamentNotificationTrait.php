<?php

namespace App\Filament\Traits;

use Filament\Notifications\Notification;
use Throwable;

trait FilamentNotificationTrait
{
    public static function showSuccessNotification(string $title = 'Prebehlo v poriadku', ?string $body = null): void
    {
        self::getSuccessNotification($title, $body)
            ->send();
    }

    public static function showErrorNotification(string $title = 'Nastala chyba', null|string|Throwable $body = null): void
    {
        self::getErrorNotification($title, $body)
            ->send();
    }

    public static function getSuccessNotification(string $title = 'Prebehlo v poriadku', ?string $body = null): Notification
    {
        return Notification::make()
            ->success()
            ->title($title)
            ->body($body);
    }

    public static function getErrorNotification(string $title = 'Nastala chyba', null|string|Throwable $body = null): Notification
    {
        return Notification::make()
            ->danger()
            ->persistent()
            ->title($title)
            ->body($body instanceof Throwable ? $body->getMessage() : $body);
    }

}
