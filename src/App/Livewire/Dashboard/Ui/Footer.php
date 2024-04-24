<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.dashboard.ui.footer')->with([
            'navigation' => $this->tabs(),
        ]);
    }

    protected function tabs(): Navigation
    {
        return Navigation::make()
            ->add('videos', fn (NavigationItem $item) => $item
                ->label(__('Videos'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2')
                ->route('dashboard.index')
            )
            ->add('tags', fn (NavigationItem $item) => $item
                ->label(__('Tags'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2')
                ->route('dashboard.content')
            );
    }
}
