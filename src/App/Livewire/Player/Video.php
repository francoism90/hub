<?php

namespace App\Livewire\Player;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            'controls' => $this->controls(),
        ]);
    }

    protected function controls(): ActionGroup
    {
        return ActionGroup::make()
            ->action($this->playAction());
    }

    protected function playAction(): Action
    {
        return Action::make('play')
            ->label(__('Play'))
            ->icon('heroicon-o-square-2-stack')
            ->iconActive('heroicon-s-square-2-stack')
            ->bladeAttributes([
                'class:label' => 'sr-only',
                'class:icon' => 'size-8'
            ]);
    }
}
