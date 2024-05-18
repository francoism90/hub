<?php

namespace App\Dashboard\Http\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class DashboardController extends Page
{
    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Dashboard'));
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.index');
    }
}
