<?php

namespace Domain\Tags\Collections;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagCollection extends Collection
{
    public function type(TagType|string|null $value = null): mixed
    {
        if (is_string($value)) {
            $value = TagType::tryFrom($value);
        }

        return $this->filter(
            fn (Tag $item) => $item->type instanceof $value
        );
    }

    public function translations(): mixed
    {
        return $this->flatMap(fn (Tag $item) => collect($item->getTranslations())
            ->only(['name', 'description'])
            ->flatten()
            ->filter()
            ->unique()
            ->all()
        );
    }

    public function seo(): mixed
    {
        return $this
            ->translations()
            ->flatten()
            ->filter()
            ->unique()
            ->implode(', ');
    }
}
