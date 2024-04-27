<?php

namespace App\Livewire\Player;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
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

    protected function controls(): Navigation
    {
        return Navigation::make()
            ->add('play', fn () => $this->playAction());
    }

    protected function playAction(): Action
    {
        return Action::make()
            ->label(__('Feed'))
            ->icon('heroicon-o-square-2-stack')
            ->iconActive('heroicon-s-square-2-stack')
            ->bladeAttributes([
                'class:label' => 'sr-only',
                'class:icon' => 'size-8'
            ]);
    }
}
