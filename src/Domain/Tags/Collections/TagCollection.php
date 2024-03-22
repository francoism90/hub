<?php

namespace Domain\Tags\Collections;

use Domain\Relates\Models\Relatable;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagCollection extends Collection
{
    public function convert(): self
    {
        return $this
            ->transform(fn (mixed $item): ?Tag => $item instanceof Tag
                ? $item
                : Tag::findByPrefixedId((string) $item)
            )
            ->filter()
            ->unique();
    }

    public function type(TagType|string|null $type = null): mixed
    {
        if (is_string($type)) {
            $type = TagType::tryFrom($type);
        }

        return $this->filter(
            fn (Tag $item) => $item->type === $type->value
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

    public function related(): mixed
    {
        return $this->flatMap(fn (Tag $item) => $item
            ->relatables()
            ->scores()
            ->get()
            ->relates()
        );
    }
}
