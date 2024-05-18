<?php

namespace App\Dashboard\Http\Controllers;

use App\Livewire\Dashboard\Tags\Edit\General;
use App\Livewire\Tags\Concerns\WithTags;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithTabs;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.dashboard')]
class TagEditController extends Page
{
    use WithTabs;
    use WithTags;

    #[Url(as: 'tab', except: 'general', history: true)]
    public string $tab = 'general';

    public function render(): View
    {
        return view('livewire.dashboard.tags.edit')->with([
            'actions' => $this->actions(),
            'tabs' => $this->tabs(),
            'current' => $this->currentTab(),
        ]);
    }

    public function delete(): void
    {
        $this->canDelete($this->tag);

        $this->tag->deleteOrFail();
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->tag);
    }

    protected function tabs(): array
    {
        return [
            Action::make('general')
                ->label(__('General'))
                ->component(General::class),
        ];
    }

    protected function actions(): array
    {
        return [
            Action::make('delete')
                ->label(__('Delete'))
                ->componentAttributes([
                    'wire:click' => 'delete',
                    'wire:confirm' => __('Are you sure you want to delete this tag?'),
                ]),

            Action::make('view')
                ->label(__('View'))
                ->componentAttributes([
                    'wire:navigate' => true,
                    'href' => route('tags.view', $this->tag),
                ]),
        ];
    }

    protected function getTitle(): string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): string
    {
        return (string) $this->tag->description;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
