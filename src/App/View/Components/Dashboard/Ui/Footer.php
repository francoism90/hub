<?php

namespace App\View\Components\Dashboard\Ui;

use Closure;
use Foxws\WireUse\Menus\Support\MenuGroup;
use Foxws\WireUse\Menus\Support\MenuItem;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.dashboard.ui.footer');
    }

    public function items(): MenuGroup
    {
        return MenuGroup::make([
            MenuItem::make()
                ->name(__('Dashboard'))
                ->route('tags.index')
                ->icon('heroicon-o-squares-2x2')
                ->activeIcon('heroicon-s-squares-2x2'),

            MenuItem::make()
                ->name(__('Content'))
                ->route('tags.index')
                ->icon('heroicon-o-rectangle-stack')
                ->activeIcon('heroicon-s-squares-2x2'),

            MenuItem::make()
                ->name(__('Analytics'))
                ->route('tags.index')
                ->icon('heroicon-o-rectangle-stack')
                ->activeIcon('heroicon-s-squares-2x2'),
        ]);
    }
}
