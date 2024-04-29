<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Concerns\WithAction;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Forms\Support\Field;
use Foxws\WireUse\Forms\Support\Schema;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithAction;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->form->fill(
            $this->getModelProperties()
        );
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.panels.general')->with([
            'schema' => $this->schema(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    protected function schema(): Schema
    {
        return Schema::make()
            ->add('name', fn (Field $field) => $field
                ->component('dashboard.forms.input')
                ->label__('Name')
                ->wireModel('form.name')
            );
    }

    public function save(): void
    {
        $this->form->submit();

        // $this->redirectAction(
        //     name: VideoManagerController::class,
        //     parameters: $this->getModel(),
        //     navigate: true,
        // );
    }

    protected function submitAction(): Action
    {
        return Action::make('save')
            ->label(__('Save changes'))
            ->bladeAttributes([
                'type' => 'submit',
            ]);
    }

    protected function getModelProperties(): array
    {
        return $this->getModel()->only(
            'name',
        );
    }

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->action->getContainer()->get('id')
        );
    }
}
