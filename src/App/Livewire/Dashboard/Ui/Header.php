<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.dashboard.ui.header')->with([
            'navigation' => $this->tabs(),
        ]);
    }

    protected function tabs(): Navigation
    {
        return Navigation::make()
            ->add('content', fn (NavigationItem $item) => $item
                ->label(__('Content'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.post')
            )
            ->add('post', fn (NavigationItem $item) => $item
                ->label(__('Post'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.post')
            );
    }
}
