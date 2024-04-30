<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Feed\Actions\Navigation;
use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

use function Livewire\store;

#[Layout('components.layouts.dashboard')]
class VideoManagerController extends Page
{
    use WithAuthorization;
    use WithVideo;

    #[Url(as: 'tab', except: 'general')]
    public string $tab = 'general';

    public Navigation $navigation;

    public function mount()
    {
        // dd();
    }

    public function render(): View
    {
        return view('livewire.dashboard.pages.content.video');
    }

    public function test()
    {
        return store($this)->get('foo');
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    // protected function actions(): Actions
    // {
    //     return Actions::make()
    //         ->active($this->tab)
    //         ->attributes([
    //             'model' => $this->video->getMorphClass(),
    //             'id' => $this->video->getRouteKey(),
    //         ])
    //         ->add('general', fn (Action $item) => $item
    //             ->wireModel('tab')
    //             ->label(__('General'))
    //             ->livewire(General::class)
    //         )
    //         ->add('assets', fn (Action $item) => $item
    //             ->wireModel('tab')
    //             ->label(__('Assets'))
    //             ->livewire(General::class)
    //         );
    // }

    protected function getTitle(): string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->video->summary;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
