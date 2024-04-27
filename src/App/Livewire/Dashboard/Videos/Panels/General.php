<?php

namespace App\Livewire\Dashboard\Videos\Panels;

use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Concerns\WithAction;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithAction;

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

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->action->getContainer()->get('id')
        );
    }
}
