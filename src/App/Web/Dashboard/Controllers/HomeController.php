<?php

declare(strict_types=1);

namespace App\Web\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;

class HomeController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('verified'),
        ];
    }

    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard/DashboardIndex', [
            //
        ]);
    }
}
