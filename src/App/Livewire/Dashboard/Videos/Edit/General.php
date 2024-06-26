<?php

namespace App\Livewire\Dashboard\Videos\Edit;

use App\Dashboard\Http\Controllers\VideoEditController;
use App\Livewire\Dashboard\Tags\Forms\TagsForm;
use App\Livewire\Dashboard\Videos\Forms\GeneralForm;
use App\Livewire\Playlists\Concerns\WithHistory;
use App\Livewire\Videos\Concerns\WithVideos;
use Domain\Videos\Actions\UpdateVideoDetails;
use Foxws\WireUse\Actions\Support\Action;
use Illuminate\View\View;
use Livewire\Component;

class General extends Component
{
    use WithHistory;
    use WithVideos;

    public GeneralForm $form;

    public TagsForm $tags;

    public function mount(): void
    {
        $this->fillForms();
    }

    public function render(): View
    {
        return view('livewire.dashboard.videos.tabs.general')->with([
            'actions' => $this->actions(),
            'titleize' => $this->titleize(),
            'snapshot' => $this->snapshot(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    public function save(): void
    {
        $this->authorize('update', $model = $this->video);

        $this->form->submit();

        app(UpdateVideoDetails::class)->execute(
            model: $model,
            attributes: $this->form->validate(),
        );

        flash()->success(__('Video has been updated!'));

        $this->redirectAction(VideoEditController::class, [$model], navigate: true);
    }

    public function fillName(): void
    {
        $this->form->name = str($this->form->get('name', ''))
            ->replace('.', ' ')
            ->headline()
            ->squish();
    }

    public function fillSnapshot(): void
    {
        $videoable = static::history()
            ->videos()
            ->firstWhere('id', $this->video->getKey());

        $this->form->snapshot = data_get($videoable?->pivot?->options, 'timestamp');
    }

    protected function fillForms(): void
    {
        $this->form->fill($this->video);
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

    protected function titleize(): Action
    {
        return Action::make('titleize')
            ->label(__('Titleize'))
            ->icon('heroicon-o-language')
            ->componentAttributes([
                'type' => 'button',
                'class:label' => 'sr-only',
                'class:icon' => 'size-6 text-secondary-400',
                'wire:click' => 'fillName()',
            ]);
    }

    protected function snapshot(): Action
    {
        return Action::make('snapshot')
            ->label(__('Snapshot'))
            ->icon('heroicon-o-camera')
            ->componentAttributes([
                'type' => 'button',
                'class:label' => 'sr-only',
                'class:icon' => 'size-6 text-secondary-400',
                'wire:click' => 'fillSnapshot()',
            ]);
    }
}
