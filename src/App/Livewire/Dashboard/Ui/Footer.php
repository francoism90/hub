<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Navigation\Concerns\WithNavigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Livewire\Component;

class Footer extends Component
{
    use WithNavigation;

    public function render()
    {
        return view('livewire.dashboard.ui.footer');
    }

    protected function navigation(): array
    {
        return [
            NavigationItem::make()
                ->name('videos')
                ->label(__('Videos'))
                ->route('dashboard.index'),

            NavigationItem::make()
                ->name('tags')
                ->label(__('Tags'))
                ->route('dashboard.content'),
        ];
    }
}
