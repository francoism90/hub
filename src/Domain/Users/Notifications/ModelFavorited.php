<?php

namespace Domain\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class ModelFavorited extends Notification
{
    use Queueable;

    public function __construct(
        protected Model $model,
    ) {
        $this->onQueue('broadcasts');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the type of the notification being broadcast.
     */
    public function broadcastType(): string
    {
        return 'model.favorited';
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->model->getRouteKey(),
            'followed' => $this->model->isFavoritedBy(auth()->user()),
        ];
    }
}
