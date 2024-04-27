<?php

namespace App\Livewire\Feed;

use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.feed.video')->with([
            'navigation' => $this->navigation(),
            'controls' => $this->controls(),
        ]);
    }

    protected function navigation(): ActionGroup
    {
        return ActionGroup::make()
            ->add('preview', fn (Action $item) => $item
                ->label(__('Toggle Previews'))
                ->icon('heroicon-o-eye')
                ->iconActive('heroicon-s-eye')
                ->state('$wire.$parent.preview')
                ->bladeAttributes([
                    'wire:click' => '$parent.$toggle(\'preview\')',
                    'class:icon' => 'size-8'
                ])
            );
    }

    protected function controls(): ActionGroup
    {
        return ActionGroup::make()
            ->add('settings', fn (Action $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('dashboard.index')
                ->bladeAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6'
                ])
            )
            ->add('settings', fn (Action $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-heart')
                ->iconActive('heroicon-s-heart')
                ->route('dashboard.index')
                ->bladeAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6'
                ])
            )
            ->add('settings', fn (Action $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-clock')
                ->iconActive('heroicon-o-clock')
                ->route('dashboard.index')
                ->bladeAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6'
                ])
            )
            ->add('post', fn (Action $item) => $item
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index')
                ->bladeAttributes([
                    'class:label' => 'sr-only',
                    'class:icon' => 'size-6'
                ])
            );
    }
}
