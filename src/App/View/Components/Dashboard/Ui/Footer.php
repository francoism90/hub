<?php

namespace App\View\Components\Dashboard\Ui;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Group;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public function render(): View|Closure|string
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
                ->activeIcon('heroicon-s-squares-2x2'),

            Action::make()
                ->name(__('Analytics'))
                ->route('tags.index')
                ->icon('heroicon-o-rectangle-stack')
                ->activeIcon('heroicon-s-squares-2x2'),
        ]);
    }
}
