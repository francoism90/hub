<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Navigation\Concerns\WithTab;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithTab;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->form->fill(
            $this->getModelProperties()
        );
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.panels.general');
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

    protected function getModelProperties(): array
    {
        return $this->getModel()->only(
            'name',
        );
    }

    protected function getModel(): Video
    {
        return data_get($this->properties, 'video');
    }
}
