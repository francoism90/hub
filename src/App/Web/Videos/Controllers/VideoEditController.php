<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\GeneralForm;
use App\Web\Videos\Concerns\WithVideo;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoEditController extends Page
{
    use WithVideo;

    public GeneralForm $form;

    public function mount(): void
    {
        $this->fillForms();
    }

    public function render(): View
    {
        return view('app.videos.edit');
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->video);
    }

    public function submit(): void
    {
        $this->authorize('update', $model = $this->video);

        $this->form->submit();

        // app(UpdateVideoDetails::class)->execute(
        //     model: $model,
        //     attributes: $this->form->validate(),
        // );

        flash()->success(__('Video has been updated!'));

        $this->redirectAction(static::class, [$model], navigate: true);
    }

    protected function fillForms(): void
    {
        $this->form->fill($this->video);
    }

    protected function getTitle(): string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): string
    {
        return (string) $this->video->summary;
    }

    public function getListeners(): array
    {
        return [
            ...$this->getVideoListeners(),
        ];
    }
}
