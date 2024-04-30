<?php

namespace App\Livewire\Dashboard\Videos\Edit;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\States\Concerns\WithState;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithState;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->form->fill($this->getModel());
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.edit.general');
    }

    public function updated(): void
    {
        $this->validate();
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

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->state->getPropertyValue('id')
        );
    }
}
