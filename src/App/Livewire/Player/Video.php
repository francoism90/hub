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
            'panel' => $this->panel(),
            'settings' => $this->settings(),
        ]);
    }

    protected function panel(): ActionGroup
    {
        return ActionGroup::make()
            ->action($this->togglePlayAction());
    }

    protected function settings(): ActionGroup
    {
        return ActionGroup::make()
            ->action($this->toggleFullscreen());
    }

    protected function togglePlayAction(): Action
    {
        return Action::make('toggle-playback')
            ->label(__('Toggle Playback'))
            ->icon('heroicon-o-pause-circle')
            ->iconActive('heroicon-o-play-circle')
            ->state('paused')
            ->bladeAttributes([
                'x-on:click' => 'togglePlayback',
                'class:label' => 'sr-only',
                'class:icon' => 'size-8'
            ]);
    }

    protected function toggleFullscreen(): Action
    {
        return Action::make('toggle-playback')
            ->label(__('Toggle Playback'))
            ->icon('heroicon-o-arrows-pointing-out')
            ->iconActive('heroicon-o-arrows-pointing-in')
            ->state('fullscreen')
            ->bladeAttributes([
                'x-on:click' => 'toggleFullscreen',
                'class:label' => 'sr-only',
                'class:icon' => 'size-6'
            ]);
    }
}
