<?php

namespace App\Web\Tags\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class Item extends Component
{
    public function __construct(
        public Tag $item,
    ) {}

    public function render(): View
    {
        return view('tags::item');
    }

    public function icon(): string
    {
        return match ($this->item->type) {
            TagType::person() => 'heroicon-o-user',
            TagType::studio() => 'heroicon-o-film',
            TagType::language() => 'heroicon-o-language',
            default => 'heroicon-o-hashtag',
        };
    }
}
