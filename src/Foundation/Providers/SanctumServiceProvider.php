<?php

namespace Foundation\Providers;

use Domain\Tokens\Models\Token;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class SanctumServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Sanctum::personalAccessTokenModel(Token::class);
    }
}
