<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Content\Videos;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithTabs;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class ContentIndexController extends Page
{
    use WithTabs;

    #[Url(as: 'tab', except: 'videos', history: true)]
    public string $tab = 'videos';

    public function mount(): void
    {
        $this->seo()->setTitle(__('Dashboard'));
        $this->seo()->setDescription(__('Content Manager'));
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.content.index')->with([
            'tabs' => $this->tabs(),
            'current' => $this->currentTab(),
        ]);
    }

    protected function tabs(): array
    {
        return [
            Action::make('videos')
                ->label(__('Videos'))
                ->component(Videos::class),

            Action::make('tags')
                ->label(__('Tags')),
        ];
    }
}
