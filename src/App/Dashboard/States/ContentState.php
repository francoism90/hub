<?php

namespace App\Dashboard\States;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Group;
use Foxws\WireUse\Support\Livewire\StateObjects\State;
use Livewire\Attributes\Url;

class ContentState extends State
{
    #[Url(as: 'tab', except: 'videos')]
    public string $tab = 'videos';

    public function tabs(): Group
    {
        return Group::make([
            Action::make()
                ->name('videos')
                ->label(__('Videos')),

            Action::make()
                ->name('tags')
                ->label(__('Tags')),
        ]);
    }

    public function tab(): ?Action
    {
        $items = $this->tabs();

        return $items->firstWhere('name', $this->tab) ?? $items->first();
    }
}
