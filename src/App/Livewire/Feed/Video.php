<?php

namespace App\Livewire\Feed;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithNavigation;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithNavigation;
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.feed.video')->with([
            'settings' => $this->getNavigation('settings')->getNodes(),
            'controls' => $this->getNavigation('controls')->getNodes(),
        ]);
    }

    protected function navigation(): array
    {
        return [
            Action::make('settings')
                ->fillNodes($this->settings()),

            Action::make('controls')
                ->fillNodes($this->controls()),
        ];
    }

    protected function settings(): array
    {
        return [
            Action::make('dashboard')
                ->label(__('Refresh Feed'))
                ->icon('heroicon-o-arrow-path-rounded-square')
                ->iconActive('heroicon-s-arrow-path-rounded-square')
                ->componentAttributes([
                    'wire:click' => '$parent.refresh()',
                ]),

            Action::make('content')
                ->label(__('Toggle Previews'))
                ->icon('heroicon-o-eye')
                ->iconActive('heroicon-s-eye')
                ->state('$wire.$parent.preview')
                ->componentAttributes([
                    'wire:click' => '$parent.$toggle(\'preview\')',
                ]),
        ];
    }

    protected function controls(): array
    {
        return [
            Action::make('content')
                ->label(__('Collections'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('dashboard.index')
                ->componentAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6',
                ]),

            Action::make('collections')
                ->label(__('Collections'))
                ->icon('heroicon-o-heart')
                ->iconActive('heroicon-s-heart')
                ->route('dashboard.index')
                ->componentAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6',
                ]),

            Action::make('favorite')
                ->label(__('Favorite'))
                ->icon('heroicon-o-clock')
                ->iconActive('heroicon-o-clock')
                ->route('dashboard.index')
                ->componentAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6',
                ]),

            Action::make('more')
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index')
                ->componentAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6',
                ]),
        ];
    }
}
