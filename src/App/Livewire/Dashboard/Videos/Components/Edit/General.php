<?php

namespace App\Livewire\Dashboard\Videos\Components\Edit;

use App\Dashboard\Http\Controllers\VideoEditController;
use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use App\Livewire\Dashboard\Videos\Forms\TagsForm;
use App\Livewire\Tags\Concerns\WithTags;
use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\States\Concerns\WithState;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithState;
    use WithTags;

    public GeneralForm $form;

    public TagsForm $tags;

    public function mount(): void
    {
        $this->fillForms();
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.edit.general')->with([
            'actions' => $this->actions(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    public function save(): void
    {
        $data = $this->form->validate();

        app(UpdateVideoDetails::class)->execute($this->getModel(), $data);

        flash()->success(__('Video has been updated!'));

        $this->redirectAction(
            name: VideoEditController::class,
            parameters: $this->getModel(),
            navigate: true,
        );
    }

    protected function fillForms(): void
    {
        $model = $this->getModel();

        $this->form->fill($model);
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

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->state->getPropertyValue('id')
        );
    }
}
