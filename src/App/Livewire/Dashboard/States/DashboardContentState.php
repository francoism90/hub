<?php

namespace App\Livewire\Dashboard\States;

use Foxws\WireUse\Navigation\Support\NavigationGroup;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Support\Livewire\StateObjects\State;

class DashboardContentState extends State
{
    public function navigation(): NavigationGroup
    {
        return NavigationGroup::make()
            ->components([
                NavigationItem::make()
                    ->name('videos')
                    ->label(__('Videos'))
                    ->wireModel('tab'),

                NavigationItem::make()
                    ->name('tags')
                    ->label(__('Tags'))
                    ->wireModel('tab'),
            ]);
    }
}
