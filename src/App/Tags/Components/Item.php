<?php

namespace App\Tags\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class Item extends Component
{
    public function __construct(
        public Tag $item,
    ) {
    }

    public function render(): View
    {
        return view('tags.item');
    }

    public function icon(): string
    {
        return match ($this->item->type) {
            TagType::Person => 'heroicon-o-user',
            TagType::Studio => 'heroicon-o-film',
            TagType::Language => 'heroicon-o-language',
            default => 'heroicon-o-hashtag',
        };
    }

    public function type(): string
    {
        return property_exists($this->item->type, 'label')
            ? $this->item->type->label
            : $this->item->type;
    }
}
