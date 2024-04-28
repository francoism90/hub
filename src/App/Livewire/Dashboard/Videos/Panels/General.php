<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Concerns\WithAction;
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
        return view('livewire.dashboard.videos.panels.general');
    }

    public function save(): void
    {
        $this->authorizeAccess();

        dd('update here');
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->getModel());
    }

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->action->getContainer()->get('id')
        );
    }
}
