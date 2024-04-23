<?php

namespace App\Livewire\Dashboard\States;

use Foxws\WireUse\Navigation\Support\NavigationGroup;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Foxws\WireUse\Support\Livewire\StateObjects\State;

class ContentState extends State
{
    public function navigation(): NavigationGroup
    {
        return NavigationGroup::make()
            ->wireModel('tab')
            ->components([
                NavigationItem::make()
                    ->name('videos')
                    ->label(__('Videos')),

                NavigationItem::make()
                    ->name('tags')
                    ->label(__('Tags')),
            ]);
    }
}
