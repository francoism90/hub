<?php

namespace App\Web\Videos\Controllers;

use App\Web\Lists\Concerns\WithHistory;
use App\Web\Videos\Forms\GeneralForm;
use App\Web\Videos\Forms\TagsForm;
use App\Web\Videos\Concerns\WithVideo;
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

    public function beautify(): void
    {
        $this->authorize('update', $this->video);

        $this->fillName();

        $this->fillSnapshot();
    }

    public function toggleTag(Tag $tag): void
    {
        $items = collect($this->form->tags);

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
        $this->form->name = str($this->form->get('name', ''))
            ->replace('.', ' ')
            ->headline()
            ->squish()
            ->value();
    }

    protected function fillSnapshot(): void
    {
         $videoable = static::history()
            ->videos()
            ->firstWhere('id', $this->video->getKey());

        $this->form->snapshot = data_get($videoable?->pivot?->options, 'timestamp');
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
