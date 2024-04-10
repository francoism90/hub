<?php

namespace Foundation\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Broadcast::routes([
            'prefix' => 'api/v1',
            'middleware' => ['api', 'auth:sanctum'],
        ]);
    }
}
