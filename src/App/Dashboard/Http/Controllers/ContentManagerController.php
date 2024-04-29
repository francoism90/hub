<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Content\Tags;
use App\Livewire\Dashboard\Content\Videos;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;
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
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): Actions
    {
        return Actions::make()
            ->active($this->tab)
            ->add('videos', fn (Action $item) => $item
                ->wireModel('tab')
                ->label(__('Videos'))
                ->livewire(Videos::class)
            )
            ->add('tags', fn (Action $item) => $item
                ->wireModel('tab')
                ->label(__('Tags'))
                ->livewire(Tags::class)
            );
    }
}
