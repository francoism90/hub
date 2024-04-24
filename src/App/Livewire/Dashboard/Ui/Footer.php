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
            ->add('dashboard', fn (NavigationItem $item) => $item
                ->label(__('Dashboard'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2')
                ->route('dashboard.index')
            )
            ->add('content', fn (NavigationItem $item) => $item
                ->label(__('Content'))
                ->icon('heroicon-o-rectangle-stack')
                ->iconActive('heroicon-s-rectangle-stack')
                ->route('dashboard.content')
            )
            ->add('post', fn (NavigationItem $item) => $item
                ->label(__('Post'))
                ->icon('heroicon-o-plus-circle')
                ->iconActive('heroicon-s-plus-circle')
                ->route('dashboard.post')
            )
            ->add('settings', fn (NavigationItem $item) => $item
                ->label(__('Settings'))
                ->icon('heroicon-o-cog')
                ->iconActive('heroicon-s-cog')
                ->route('dashboard.settings')
            )
            ->add('activity', fn (NavigationItem $item) => $item
                ->label(__('Activity'))
                ->icon('heroicon-o-bell')
                ->iconActive('heroicon-s-bell')
                ->route('dashboard.activity')
            );
    }
}
