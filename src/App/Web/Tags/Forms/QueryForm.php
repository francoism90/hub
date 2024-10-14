<?php

declare(strict_types=1);

namespace App\Web\Tags\Forms;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|max:255')]
    public string $query = '';

    #[Validate('nullable|string|in:recent,longest,shortest')]
    public string $type = '';

    protected function beforeValidate(): void
    {
        app(Video::class)->forgetRandomSeed('videos-tagged');
    }

    public function query(): string
    {
        return str($this->get('query', ''))
            ->title()
            ->squish()
            ->value();
    }
}
