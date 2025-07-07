<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Media\Listeners\SetMediaStreamData;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\MediaLibrary\Conversions\Events\ConversionWillStartEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ConversionWillStartEvent::class => [
            SetMediaStreamData::class,
        ],
    ];
}
