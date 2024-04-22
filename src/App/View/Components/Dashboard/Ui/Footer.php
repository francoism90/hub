<?php

namespace App\View\Components\Dashboard\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Group;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public function render(): View
    {
        return view('components.dashboard.ui.footer');
    }

    public function actions(): Group
    {
        return Group::make([
            Action::make()
                ->name(__('Dashboard'))
                ->route('dashboard.index')
                ->icon('heroicon-o-squares-2x2')
                ->activeIcon('heroicon-s-squares-2x2'),

            Action::make()
                ->name(__('Content'))
                ->route('tags.index')
                ->icon('heroicon-o-rectangle-stack')
                ->activeIcon('heroicon-s-rectangle-stack'),

            Action::make()
                ->name(__('Analytics'))
                ->route('tags.index')
                ->icon('heroicon-o-chart-bar')
                ->activeIcon('heroicon-s-chart-bar'),

            Action::make()
                ->name(__('Settings'))
                ->route('tags.index')
                ->icon('heroicon-o-cog')
                ->activeIcon('heroicon-s-cog'),

            Action::make()
                ->name(__('Account'))
                ->route('tags.index')
                ->icon('heroicon-o-user')
                ->activeIcon('heroicon-s-user'),
        ]);
    }
}
