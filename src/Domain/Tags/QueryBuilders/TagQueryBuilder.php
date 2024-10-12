<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class TagQueryBuilder extends Builder
{
    public function random(int $ttl = 60 * 60): self
    {
        return $this
            ->randomSeed('tags-random', $ttl);
    }

    public function type(TagType|string $value): self
    {
        $type = $value instanceof TagType ? $value : TagType::tryFrom($value);

        return $this->when($type, fn (Builder $query) => $query
            ->where('type', $type)
        );
    }

    public function popular(): QueryBuilder
    {
        return DB::table('taggables')
            ->selectRaw('id, prefixed_id, name, count(tag_id) as tagged_count')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('tagged_count', 'desc');
    }
}
