<?php

namespace App\Dashboard\Controllers;

use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\View\View;

class DashboardIndexController extends Page
{
    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Dashboard'));
    }

    public function render(): View
    {
        return view('dashboard.index');
    }
}
