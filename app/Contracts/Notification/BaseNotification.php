<?php

namespace App\Contracts\Notification;

use App\Contracts\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    public string $connection = 'redis';

    public string $queue = 'default';

    public int $delay = 0;

    public int $tries = 1;

    abstract public static function getGroupTitle(): string;

    public function via(Authenticatable $user): array
    {
        return ['database'];
    }

    public function toDatabase(Authenticatable $user): DatabaseMessage
    {
        return DatabaseMessage::make();
    }
}
