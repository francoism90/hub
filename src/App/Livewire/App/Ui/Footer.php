<?php

namespace App\Livewire\App\Ui;

use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.app.ui.footer')->with([
            'navigation' => $this->tabs(),
        ]);
    }

    protected function tabs(): Navigation
    {
        return Navigation::make()
            ->add('home', fn (NavigationItem $item) => $item
                ->label(__('Feed'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('home')
            )
            ->add('discover', fn (NavigationItem $item) => $item
                ->label(__('Discover'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.content')
            )
            ->add('settings', fn (NavigationItem $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-bookmark')
                ->iconActive('heroicon-s-bookmark')
                ->route('dashboard.index')
            )
            ->add('activity', fn (NavigationItem $item) => $item
                ->label(__('Account'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.index')
            )
            ->add('post', fn (NavigationItem $item) => $item
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index')
            );
    }
}
