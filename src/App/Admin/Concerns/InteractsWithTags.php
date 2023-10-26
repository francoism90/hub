<?php

namespace App\Admin\Concerns;

use Domain\Tags\Models\Tag;
use Filament\Forms\Components\Select;

trait InteractsWithTags
{
    public static function tags(): Select
    {
        return Select::make('tags')
            ->label(__('Tags'))
            ->nullable()
            ->multiple()
            ->relationship(
                name: 'tags',
                titleAttribute: 'name',
            )
            ->searchable()
            ->searchDebounce(300)
            ->getSearchResultsUsing(fn (string $search): array => static::getTagResults($search))
            ->getOptionLabelFromRecordUsing(fn (Tag $record): mixed => $record->name);
    }

    protected static function getTagResults(string $query = '*', int $limit = 10): array
    {
        return Tag::search($query)
            ->take($limit)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
