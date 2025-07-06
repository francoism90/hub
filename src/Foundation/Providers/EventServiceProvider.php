<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Media\Listeners\ProcessMedia;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\MediaLibrary\Conversions\Events\ConversionWillStartEvent;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        Event::listen(listener: ProcessMedia::class, events: [
            MediaHasBeenAddedEvent::class,
            ConversionWillStartEvent::class,
        ]);
    }
}
