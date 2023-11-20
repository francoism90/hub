<?php

namespace App\Filament\Forms\Components;

use Domain\Tags\Models\Tag;
use Filament\Forms\Components\Select;

class TagInput extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->maxItems(10);

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

    public function getSearchResults(string $search = ''): array
    {
        if (! is_string($search) || blank($search)) {
            return [];
        }

        return Tag::search($search)
            ->take($this->getMaxItems())
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
