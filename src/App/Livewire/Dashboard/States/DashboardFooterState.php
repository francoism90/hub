<?php

namespace App\Livewire\Dashboard\States;

use Foxws\WireUse\Navigation\Support\NavigationGroup;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Support\Livewire\StateObjects\State;

class DashboardFooterState extends State
{
    public function navigation(): NavigationGroup
    {
        return NavigationGroup::make()
            ->components([
                 NavigationItem::make()
                    ->name('videos')
                    ->label(__('Videos'))
                    ->route('dashboard.index'),

                NavigationItem::make()
                    ->name('tags')
                    ->label(__('Tags'))
                    ->route('dashboard.content'),
            ]);
    }
}
