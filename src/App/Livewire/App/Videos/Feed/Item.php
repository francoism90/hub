<?php

namespace App\Livewire\App\Videos\Feed;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Foxws\WireUse\Navigation\Support\Navigation;
use Foxws\WireUse\Navigation\Support\NavigationItem;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Session;
use Livewire\Component;

class Item extends Component
{
    use WithVideo;

    #[Session]
    public bool $preview = false;

    public function render()
    {
        return view('livewire.app.videos.feed.item')->with([
            'navigation' => $this->navigation(),
            'controls' => $this->controls(),
        ]);
    }

    protected function navigation(): Navigation
    {
        return Navigation::make()
            ->add('preview', fn (NavigationItem $item) => $item
                ->label(__('Toggle Preview'))
                ->icon('heroicon-o-eye')
                ->iconActive('heroicon-s-eye')
                ->active($this->preview)
                ->bladeAttributes([
                    'wire:click' => new HtmlString('$toggle(\'preview\')'),
                ])
        );
    }

    protected function controls(): Navigation
    {
        return Navigation::make()
            ->add('settings', fn (NavigationItem $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-square-2-stack')
                ->iconActive('heroicon-s-square-2-stack')
                ->route('dashboard.index')
            )
            ->add('settings', fn (NavigationItem $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-heart')
                ->iconActive('heroicon-s-heart')
                ->route('dashboard.index')
            )
            ->add('settings', fn (NavigationItem $item) => $item
                ->label(__('Collections'))
                ->icon('heroicon-o-clock')
                ->iconActive('heroicon-o-clock')
                ->route('dashboard.index')
            )
            ->add('post', fn (NavigationItem $item) => $item
                ->label(__('More'))
                ->icon('heroicon-o-ellipsis-horizontal')
                ->iconActive('heroicon-s-ellipsis-horizontal')
                ->route('dashboard.index')
            );
    }
}
