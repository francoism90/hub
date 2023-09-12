<?php

namespace App\Web\Videos\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('videos::filters');
    }

    public static function showTags(): bool
    {
        return ! method_exists(static::class, 'disableTagsFilter');
    }
}
