<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class DashboardVideoController extends Page
{
    use WithVideo;

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
