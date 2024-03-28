<?php

namespace App\Search\Forms;

use Foxws\LivewireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    #[Validate('nullable|string|max:255')]
    public string $search = '';

    #[Validate('nullable|string|in:longest,shortest,released|max:255')]
    public string $sort = '';

    #[Validate('nullable|string|in:asc,desc')]
    public string $direction = '';

    #[Validate('nullable|array|exists:tags,prefixed_id|max:10')]
    public array $tags = [];

    #[Validate('nullable|array|in:caption|max:5')]
    public array $features = [];
}
