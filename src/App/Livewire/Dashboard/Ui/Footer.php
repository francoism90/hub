<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithNavigation;
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
            Action::make('dashboard')
                ->label(__('Dashboard'))
                ->icon('heroicon-o-squares-2x2')
                ->iconActive('heroicon-s-squares-2x2')
                ->route('dashboard.index'),

            Action::make('content')
                ->label(__('Content'))
                ->icon('heroicon-o-rectangle-stack')
                ->iconActive('heroicon-s-rectangle-stack')
                ->route('dashboard.content.index'),

            Action::make('post')
                ->label(__('Post'))
                ->icon('heroicon-o-plus-circle')
                ->iconActive('heroicon-s-plus-circle')
                ->route('dashboard.post'),

            Action::make('settings')
                ->label(__('Settings'))
                ->icon('heroicon-o-cog')
                ->iconActive('heroicon-s-cog')
                ->route('dashboard.settings'),

            Action::make('activity')
                ->label(__('Activity'))
                ->icon('heroicon-o-bell')
                ->iconActive('heroicon-s-bell')
                ->route('dashboard.activity')
        ];
    }
}
