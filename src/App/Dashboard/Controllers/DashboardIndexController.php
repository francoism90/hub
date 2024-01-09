<?php

namespace App\Dashboard\Controllers;

use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\View\View;

class DashboardIndexController extends Page
{
    public function render(): View
    {
        return view('dashboard.index');
    }
}
