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
        return view('livewire.app.feed.video');
    }

    protected function navigation(): array
    {
        return [
            Action::make('settings')
                ->fillNodes($this->settings()),
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

    // protected function actions(): Actions
    // {
    //     return Actions::make()
    //         ->add('settings', fn (Action $item) => $item
    //             ->label(__('Collections'))
    //             ->icon('heroicon-o-square-2-stack')
    //             ->iconActive('heroicon-s-square-2-stack')
    //             ->route('dashboard.index')
    //             ->bladeAttributes([
    //                 'class:label' => 'sr-only',
    //                 'class:icon' => 'size-6',
    //             ])
    //         )
    //         ->add('settings', fn (Action $item) => $item
    //             ->label(__('Collections'))
    //             ->icon('heroicon-o-heart')
    //             ->iconActive('heroicon-s-heart')
    //             ->route('dashboard.index')
    //             ->bladeAttributes([
    //                 'class:label' => 'sr-only',
    //                 'class:icon' => 'size-6',
    //             ])
    //         )
    //         ->add('settings', fn (Action $item) => $item
    //             ->label(__('Collections'))
    //             ->icon('heroicon-o-clock')
    //             ->iconActive('heroicon-o-clock')
    //             ->route('dashboard.index')
    //             ->bladeAttributes([
    //                 'class:label' => 'sr-only',
    //                 'class:icon' => 'size-6',
    //             ])
    //         )
    //         ->add('post', fn (Action $item) => $item
    //             ->label(__('More'))
    //             ->icon('heroicon-o-ellipsis-horizontal')
    //             ->iconActive('heroicon-s-ellipsis-horizontal')
    //             ->route('dashboard.index')
    //             ->bladeAttributes([
    //                 'class:label' => 'sr-only',
    //                 'class:icon' => 'size-6',
    //             ])
    //         );
    // }
}
