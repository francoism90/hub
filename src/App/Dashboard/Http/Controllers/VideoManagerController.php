<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Videos\Panels\General;
use App\Livewire\Videos\Concerns\WithVideo;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class VideoManagerController extends Page
{
    use WithAuthorization;
    use WithVideo;

    #[Url(as: 'tab', except: 'general')]
    public string $tab = 'general';

    public function render(): View
    {
        return view('livewire.dashboard.pages.content.video')->with([
            'actions' => $this->actions(),
        ]);
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    protected function actions(): ActionGroup
    {
        return ActionGroup::make()
            ->active($this->tab)
            ->attributes([
                'model' => $this->video->getMorphClass(),
                'id' => $this->video->getRouteKey(),
            ])
            ->add('general', fn (Action $item) => $item
                ->wireModel('tab')
                ->label(__('General'))
                ->livewire(General::class)
            )
            ->add('assets', fn (Action $item) => $item
                ->wireModel('tab')
                ->label(__('Assets'))
                ->livewire(General::class)
            );
    }

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
