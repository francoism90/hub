<?php

namespace App\Dashboard\Http\Controllers;

use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class DashboardContentController extends Page
{
    #[Url(as: 'tab', except: 'videos')]
    public string $tab = 'videos';

    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Content Manager'));
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.content')->with([
            'navigation' => $this->tabs(),
        ]);
    }

    protected function tabs(): Navigation
    {
        return Navigation::make()
            ->active($this->tab)
            ->add('videos', fn (NavigationItem $item) => $item
                ->label(__('Videos'))
                ->wireModel('tab')
            )
            ->add('tags', fn (NavigationItem $item) => $item
                ->label(__('Tags'))
                ->wireModel('tab')
            );
    }
}
