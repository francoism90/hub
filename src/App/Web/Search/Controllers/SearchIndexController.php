<?php

declare(strict_types=1);

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;

class SearchIndexController extends Page
{
    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('app.search.index')->with([
            'items' => $this->getCollection(),
            'suggestions' => $this->getSuggestions(),
        ]);
    }

    public function updatedForm(): void
    {
        $this->form->submit();
    }

    public function submit(): void
    {
        $this->form->submit();
    }

    public function blank(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    public function setQuery(?string $query = null): void
    {
        $this->form->query = $query;
    }

    protected function getSuggestions(): array
    {
        if ($this->form->query()) {
            return [];
        }

        return Tag::query()
            ->inRandomOrder()
            ->limit(2)
            ->pluck('name')
            ->all();
    }

    protected function getCollection(): array
    {
        return [
            GroupSet::Relevant,
            GroupSet::Longest,
            GroupSet::Shortest,
        ];
    }

    protected function getTitle(): ?string
    {
        return __('Search');
    }

    protected function getDescription(): ?string
    {
        return __('Search for videos');
    }
}
