<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Content\Tags;
use App\Livewire\Dashboard\Content\Videos;
use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class ContentManagerController extends Page
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
        return view('livewire.dashboard.pages.content.index')->with([
            'navigation' => $this->tabs(),
        ]);
    }

    protected function tabs(): Navigation
    {
        return Navigation::make()
            ->active($this->tab)
            ->add('videos', fn (NavigationItem $item) => $item
                ->wireModel('tab')
                ->label(__('Videos'))
                ->livewire(Videos::class)
            )
            ->add('tags', fn (NavigationItem $item) => $item
                ->wireModel('tab')
                ->label(__('Tags'))
                ->livewire(Tags::class)
            );
    }
}