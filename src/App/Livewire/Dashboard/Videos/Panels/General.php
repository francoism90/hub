<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Concerns\WithAction;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithAction;
    use WithAuthorization;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->form->fill(
            $this->getModel()->only('name')
        );
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.panels.general')->with([
            'submit' => $this->submitAction(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    public function save(): void
    {
        $this->authorizeAccess();

        app(UpdateVideoDetails::class)->execute(
            $this->getModel(),
            $this->form->all(),
        );
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->getModel());
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
            $this->action->getContainer()->get('id')
        );
    }
}
