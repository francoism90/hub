<?php

declare(strict_types=1);

namespace App\Marketing\Controllers;

use Foundation\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Marketing/Index');
    }
}
