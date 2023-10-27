<?php

namespace App\Admin\Forms\Components;

use Closure;
use Domain\Tags\Models\Tag;
use Filament\Forms\Components\Select;

class TagInput extends Select
{
    protected int|Closure|null $limit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->limit(10);

        $this->label(__('Tags'));

        $this->nullable();

        $this->multiple();

        $this->relationship(
            name: 'tags',
            titleAttribute: 'name',
        );

        $this->searchable();

        $this->searchDebounce(300);

        $this->getOptionLabelFromRecordUsing(fn (Tag $record): mixed => $record->name);
    }

    public function limit(int|Closure|null $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function getSearchResults(string $search = ''): array
    {
        if (! is_string($search) || blank($search)) {
            return [];
        }

        return Tag::search($search)
            ->take($this->getLimit())
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getLimit(): ?int
    {
        return $this->evaluate($this->limit);
    }
}
