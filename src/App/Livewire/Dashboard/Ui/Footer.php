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
                ->route('dashboard.index')
            )
            ->add('tags', fn (NavigationItem $item) => $item
                ->label(__('Tags'))
                ->route('dashboard.content')
            );
    }
}
