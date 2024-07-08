<?php

namespace App\Livewire\App\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('ui.footer')->with([
            // 'actions' => $this->actions(),
        ]);
    }

    protected function actions(): array
    {
        return [
            Action::make('search')
                ->label(__('Search'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('search'),

            Action::make('collections')
                ->label(__('Collections'))
                ->icon('heroicon-o-bookmark')
                ->iconActive('heroicon-s-bookmark')
                ->route('dashboard.content.index'),

            Action::make('activity')
                ->label(__('Activity'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.content.index'),

            Action::make('more')
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index'),
        ];
    }
}
