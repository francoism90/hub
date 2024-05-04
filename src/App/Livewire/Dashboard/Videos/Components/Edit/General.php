<?php

namespace App\Livewire\Dashboard\Videos\Components\Edit;

use App\Dashboard\Http\Controllers\VideoEditController;
use App\Livewire\Dashboard\Tags\Forms\TagsForm;
use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use App\Livewire\Dashboard\Videos\States\VideoState;
use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Tags\Concerns\WithTags;
use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\States\Concerns\WithState;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property VideoState $state
 */
class General extends Component
{
    use WithHistory;
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
            'snapshot' => $this->snapshot(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    public function save(): void
    {
        $this->authorize('update', $model = $this->getModel());

        $this->form->submit();

        app(UpdateVideoDetails::class)->execute(
            model: $model,
            attributes: $this->form->validate(),
        );

        flash()->success(__('Video has been updated!'));

        $this->redirectAction(
            name: VideoEditController::class,
            parameters: $model,
            navigate: true,
        );
    }

    public function fillSnapshot(): void
    {
        $videoable = static::history()
            ->videos()
            ->firstWhere('id', $this->getModel()->getKey());

        $this->form->snapshot = data_get($videoable?->pivot?->options, 'timestamp');
    }

    protected function fillForms(): void
    {
        $this->form->fill(
            $this->getModel()
        );
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

    protected function snapshot(): Action
    {
        return Action::make('snapshot')
            ->label(__('Snapshot'))
            ->icon('heroicon-o-camera')
            ->componentAttributes([
                'type' => 'button',
                'class:icon' => 'size-10',
                'class:label' => 'sr-only',
                'wire:click' => 'fillSnapshot()',
            ]);
    }

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->state->id
        );
    }
}
