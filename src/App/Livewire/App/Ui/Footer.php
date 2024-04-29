<?php

namespace App\Livewire\App\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.app.ui.footer')->with([
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): Actions
    {
        return Actions::make()
            ->add('home', fn (Action $item) => $item
                ->label(__('Feed'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('home')
            )
            ->add('discover', fn (Action $item) => $item
                ->label(__('Discover'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.content')
            )
            ->add('settings', fn (Action $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-bookmark')
                ->iconActive('heroicon-s-bookmark')
                ->route('dashboard.index')
            )
            ->add('activity', fn (Action $item) => $item
                ->label(__('Account'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.index')
            )
            ->add('post', fn (Action $item) => $item
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index')
            );
    }
}
