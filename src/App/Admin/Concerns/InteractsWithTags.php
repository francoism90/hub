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
            ->getSearchResultsUsing(fn (string $search): array => static::tagSearch($search))
            ->getOptionLabelFromRecordUsing(fn (Tag $record) => $record->name);
    }

    protected static function tagSearch(string $query = '*'): array
    {
        return Tag::search($query)
            ->take(10)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
