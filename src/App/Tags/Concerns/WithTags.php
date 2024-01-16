<?php

namespace App\Tags\Concerns;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;

trait WithTags
{
    public function bootWithTags(): void
    {
        $this->authorize('viewAny', Tag::class);
    }

    protected function tagTypes(): Collection
    {
        return collect(TagType::toValues());
    }

    protected function findTagType(string $value): ?TagType
    {
        return TagType::tryFrom($value);
    }

    protected function findTagModel(string $value): ?Tag
    {
        return Tag::findByPrefixedId($value);
    }
}
