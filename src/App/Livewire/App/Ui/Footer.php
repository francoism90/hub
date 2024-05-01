<?php

namespace App\Livewire\App\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.app.ui.footer')->with([
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): array
    {
        return [
            Action::make('feed')
                ->label(__('Feed'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('home'),

            Action::make('discover')
                ->label(__('Discover'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.index'),

            Action::make('collections')
                ->label(__('Collections'))
                ->icon('heroicon-o-bookmark')
                ->iconActive('heroicon-s-bookmark')
                ->route('dashboard.index'),

            Action::make('activity')
                ->label(__('Activity'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.index'),

            Action::make('more')
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index'),
        ];
    }
}
