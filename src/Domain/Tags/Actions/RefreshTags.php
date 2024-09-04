<?php

namespace Domain\Tags\Actions;

use Illuminate\Support\Facades\Cache;

class RefreshTags
{
    public function execute(): void
    {
        Cache::forget('tags');
    }
}
