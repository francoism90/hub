<?php

namespace App\Livewire\Player;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithAuthentication;
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            'navigation' => $this->navigation(),
            'panel' => $this->panel(),
            'settings' => $this->settings(),
        ]);
    }

    protected function navigation(): ActionGroup
    {
        return ActionGroup::make()
            ->add('home', fn (Action $item) => $item
                ->label(__('Feed'))
                ->icon('heroicon-m-arrow-left-circle')
                ->route('home')
                ->bladeAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-10 fill-secondary-100/50'
                ])
            );
    }

    protected function panel(): ActionGroup
    {
        return ActionGroup::make()
            ->action($this->togglePlayAction());
    }

    protected function settings(): ActionGroup
    {
        return ActionGroup::make()
            ->actionIf(static::can('update', $this->video), $this->manage())
            ->action($this->toggleFullscreen());
    }

    protected function manage(): Action
    {
        return Action::make('edit')
            ->label(__('Manage Video'))
            ->icon('heroicon-o-book-open')
            ->route('dashboard.videos.edit', $this->video)
            ->bladeAttributes([
                'class:label' => 'sr-only',
                'class:icon' => 'size-6'
            ]);
    }

    protected function togglePlayAction(): Action
    {
        return Action::make('toggle-playback')
            ->label(__('Toggle Playback'))
            ->icon('heroicon-m-pause')
            ->iconActive('heroicon-m-play')
            ->state('paused')
            ->bladeAttributes([
                'x-on:click' => 'togglePlayback',
                'class:label' => 'sr-only',
                'class:icon' => 'size-6'
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
