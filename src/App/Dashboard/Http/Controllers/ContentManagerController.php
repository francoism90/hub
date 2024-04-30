<?php

namespace App\Dashboard\Http\Controllers;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class ContentManagerController extends Page
{
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
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): array
    {
        return [
            Action::make('videos')
                ->label(__('Videos'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2'),

            Action::make('tags')
                ->label(__('Content'))
                ->icon('heroicon-o-rectangle-stack')
                ->iconActive('heroicon-s-rectangle-stack'),
        ];
    }
}
