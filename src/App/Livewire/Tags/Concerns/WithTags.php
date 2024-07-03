<?php

namespace App\Livewire\Tags\Concerns;

use Domain\Tags\Models\Tag;

trait WithTags
{
    public function bootWithTags(): void
    {
        $this->authorize('viewAny', Tag::class);
    }
}
