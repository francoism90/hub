<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\States\DashboardContentState;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class DashboardContentController extends Page
{
    #[Url(as: 'tab', except: 'videos')]
    public string $tab = 'videos';

    public DashboardContentState $state;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Content Manager'));
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.content');
    }
}
