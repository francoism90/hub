<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Videos\Concerns\WithVideo;
use App\Web\Videos\Forms\GeneralForm;
use App\Web\Videos\Forms\TagsForm;
use Domain\Tags\Models\Tag;
use Domain\Videos\Actions\UpdateVideoDetails;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class VideoEditController extends Page
{
    use WithVideo;

    public GeneralForm $form;

    public TagsForm $tags;

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

    public function updatedForm(): void
    {
        $this->form->validate();
    }

    public function submit(): void
    {
        $this->authorize('update', $model = $this->video);

        $this->form->submit();

        app(UpdateVideoDetails::class)->execute(
            model: $model,
            attributes: $this->form->validate(),
        );

        flash()->success(__('Video has been updated!'));

        $this->redirectAction(static::class, [$model], navigate: true);
    }

    public function delete(): void
    {
        $this->canDelete($this->video);

        $this->video->deleteOrFail();

        $this->redirect(LibraryIndexController::class, navigate: true);
    }

    public function beautify(): void
    {
        $this->canUpdate($this->video);

        $this->fillName();

        $this->fillSnapshot();
    }

    public function toggleTag(Tag $tag): void
    {
        $this->canUpdate($this->video);

        $items = collect($this->form->get('tags', []));

        $items = $items->contains('id', $tag->getRouteKey())
            ? $items->reject(fn (array $item) => $item['id'] === $tag->getRouteKey())
            : $items->push(['id' => $tag->getRouteKey(), 'name' => $tag->name]);

        $this->form->tags = $items->toArray();
    }

    protected function fillForms(): void
    {
        $this->form->fill($this->video);
    }

    protected function fillName(): void
    {
        if ($this->form->filled('name')) {
            return;
        }

        $this->form->name = str($this->getVideo()->name)
            ->replace('.', ' ')
            ->headline()
            ->transliterate()
            ->squish()
            ->value();
    }

    protected function fillSnapshot(): void
    {
        if ($this->form->filled('snapshot')) {
            return;
        }

        $time = $this->getVideo()->timeCodeFor(auth()->user());

        if (is_numeric($time) && $time > 0) {
            $this->form->snapshot = round($time, 2);
        }
    }

    protected function getTitle(): ?string
    {
        return (string) $this->video->title;
    }

    protected function getDescription(): ?string
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
