<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Tokens\Models\Token;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class SanctumServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(Token::class);
    }
}
