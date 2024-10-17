<?php

declare(strict_types=1);

namespace App\Web\Videos\Forms;

use Domain\Groups\Actions\ResetMixerGroups;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|exists:groups,prefixed_id')]
    public string $group = '';

    protected function handle(): void
    {
        app(ResetMixerGroups::class)->execute(auth()->user());
    }
}
