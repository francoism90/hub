<?php

namespace App\Web\Forms\Concerns;

use Livewire\Attributes\Validate;

trait WithTag
{
    #[Validate('nullable|string')]
    public ?string $tag = null;

    public function resetTag(): void
    {
        $this->reset('tag');
    }
}
