<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Dashboard\Http\Controllers\VideoManagerController;
use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Concerns\WithAction;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class General extends Component
{
    use WithAction;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->form->populate(
            $this->getModel()
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
        $this->form->submit();

        $this->redirectAction(
            name: VideoManagerController::class,
            parameters: $this->getModel(),
            navigate: true,
        );
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
