<?php

namespace App\Livewire\Dashboard\Tags\Edit;

use App\Livewire\Dashboard\Tags\Forms\GeneralForm;
use App\Livewire\Dashboard\Tags\Forms\TagsForm;
use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Tags\Concerns\WithTags;
use Domain\Tags\Actions\UpdateTagDetails;
use Domain\Tags\Enums\TagType;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithHistory;
    use WithTags;

    public GeneralForm $form;

    public TagsForm $tags;

    public function mount(): void
    {
        $this->fillForms();
    }

    public function render(): View
    {
        return view('livewire.dashboard.tags.tabs.general')->with([
            'actions' => $this->actions(),
            'types' => TagType::cases(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    public function save(): void
    {
        $this->authorize('update', $this->tag);

        $this->form->submit();

        app(UpdateTagDetails::class)->execute(
            model: $this->tag,
            attributes: $this->form->validate(),
        );

        flash()->success(__('Tag has been updated!'));
    }

    protected function fillForms(): void
    {
        $this->form->fill($this->tag);
    }

    protected function actions(): array
    {
        return [
            Action::make('save')
                ->label(__('Save changes'))
                ->componentAttributes([
                    'type' => 'submit',
                ]),
        ];
    }
}
