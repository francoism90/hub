<?php

namespace App\Admin\Concerns;

use Domain\Tags\Models\Tag;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;

trait InteractsWithTags
{
    public static function tags(): Select
    {
        return Select::make('tags')
            ->label(__('Tags'))
            ->nullable()
            ->multiple()
            ->getSearchResultsUsing(fn (string $search): array => static::tagSearch($search))
            ->getOptionLabelsUsing(fn (array $values): array => static::tagLabels($values))
            ->afterStateHydrated(function (Select $component, Model $record) {
                $component->state(static::tagOptions($record));
            });
    }

    protected static function tagOptions(Model $record): array
    {
        return $record
            ->tags()
            ->pluck('prefixed_id')
            ->toArray();
    }

    protected static function tagLabels(array $values = []): array
    {
        return Tag::query()
            ->whereIn('prefixed_id', $values)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected static function tagSearch(string $query = '*'): array
    {
        return Tag::search($query)
            ->take(10)
            ->get()
            ->pluck('name', 'prefixed_id')
            ->toArray();
    }
}
