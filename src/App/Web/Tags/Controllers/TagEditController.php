<?php

declare(strict_types=1);

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTag;
use App\Web\Tags\Forms\GeneralForm;
use App\Web\Tags\Forms\RelatedForm;
use Domain\Tags\Actions\UpdateTagDetails;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class TagEditController extends Page
{
    use WithTag;

    public GeneralForm $form;

    public RelatedForm $related;

    public function mount(): void
    {
        $this->fillForms();
    }

    public function render(): View
    {
        return view('app.tags.edit')->with([
            'types' => $this->getTagTypes(),
        ]);
    }

    protected function authorizeAccess(): void
    {
        $this->canUpdate($this->tag);
    }

    public function updatedForm(): void
    {
        $this->form->validate();
    }

    public function submit(): void
    {
        $this->authorize('update', $model = $this->tag);

        $this->form->submit();

        app(UpdateTagDetails::class)->execute(
            model: $model,
            attributes: $this->form->validate(),
        );

        flash()->success(__('Tag has been updated!'));

        $this->redirectAction(static::class, [$model], navigate: true);
    }

    public function delete(): void
    {
        $this->canDelete($this->tag);

        $this->tag->deleteOrFail();

        $this->redirectRoute('home', navigate: true);
    }

    public function beautify(): void
    {
        $this->canUpdate($this->tag);

        $this->fillName();
    }

    public function toggleRelated(Tag $tag): void
    {
        $this->canUpdate($this->tag);

        $items = collect($this->form->related);

        $items = $items->contains('id', $tag->getRouteKey())
            ? $items->reject(fn (array $item) => $item['id'] === $tag->getRouteKey())
            : $items->push(['id' => $tag->getRouteKey(), 'name' => $tag->name]);

        $this->form->related = $items->toArray();
    }

    protected function fillForms(): void
    {
        $this->form->fill($this->tag);
    }

    protected function fillName(): void
    {
        if ($this->form->filled('name')) {
            return;
        }

        $this->form->name = str($this->getTag()->name)
            ->replace('.', ' ')
            ->headline()
            ->transliterate()
            ->squish()
            ->value();
    }

    protected function getTitle(): ?string
    {
        return (string) $this->tag->name;
    }

    protected function getDescription(): ?string
    {
        return (string) $this->tag->description;
    }

    protected function getTagTypes(): array
    {
        return collect(TagType::cases())
            ->flatMap(fn (TagType $type) => [$type->value => $type->label()])
            ->toArray();
    }

    public function getListeners(): array
    {
        return [
            ...$this->getTagListeners(),
        ];
    }
}
