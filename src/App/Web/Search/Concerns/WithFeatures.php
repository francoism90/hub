<?php

namespace App\Web\Search\Concerns;

use Livewire\Attributes\Computed;

trait WithFeatures
{
    #[Computed]
    public function features(): array
    {
        return [
            'caption' => __('Captions'),
        ];
    }

    public function hasFeature(string $value): bool
    {
        return in_array($value, (array) $this->form->feature);
    }
}
