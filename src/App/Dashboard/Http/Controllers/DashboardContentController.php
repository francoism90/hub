<?php

namespace App\Dashboard\Http\Controllers;

use App\Dashboard\States\ContentState;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class DashboardContentController extends Page
{
    public ContentState $state;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Content Manager'));
    }

    public function render(): View
    {
        return view('pages.dashboard.content');
    }
}
