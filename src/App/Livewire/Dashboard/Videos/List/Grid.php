<?php

namespace App\Livewire\Dashboard\Videos\Edit;

use App\Livewire\Videos\Concerns\WithVideos;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\States\Concerns\WithState;
use Illuminate\View\View;
use Livewire\Component;

class Grid extends Component
{
    use WithState;
    use WithVideos;

    // public GeneralForm $form;

    public function mount(): void
    {
        // $this->fillForms();
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.list.grid')->with([
            'actions' => $this->actions(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    protected function fillForms(): void
    {
        //
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
