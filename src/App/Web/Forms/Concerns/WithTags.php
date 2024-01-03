<?php

namespace App\Web\Forms\Concerns;

use Livewire\Attributes\Validate;

trait WithTags
{
    #[Validate('nullable|array|max:3')]
    public ?string $tags = null;

    public function resetTags(): void
    {
        $this->reset('tags');
    }
}
