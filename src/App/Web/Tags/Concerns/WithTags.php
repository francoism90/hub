<?php

declare(strict_types=1);

namespace App\Web\Tags\Concerns;

use Domain\Tags\Models\Tag;

trait WithTags
{
    public function bootWithTags(): void
    {
        $this->authorize('viewAny', Tag::class);
    }
}
