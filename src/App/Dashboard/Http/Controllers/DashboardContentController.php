<?php

namespace App\Dashboard\Http\Controllers;

use Foxws\WireUse\Navigation\Concerns\WithNavigation;
use Foxws\WireUse\Navigation\Contracts\HasNavigation;
use Foxws\WireUse\Navigation\Support\NavigationGroup;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class DashboardContentController extends Page implements HasNavigation
{
    use WithNavigation;

    #[Url(as: 'tab', except: 'videos')]
    public string $tab = 'videos';

    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Content Manager'));
    }

    public function render(): View
    {
        return view('pages.dashboard.content');
    }

    public function navigation(): NavigationGroup
    {
        return NavigationGroup::make([
            NavigationItem::make()
                ->name('videos')
                ->label(__('Videos')),

            NavigationItem::make()
                ->name('tags')
                ->label(__('Tags')),
        ]);
    }
}
