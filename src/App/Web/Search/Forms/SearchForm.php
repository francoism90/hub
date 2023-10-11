<?php

namespace App\Web\Search\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class SearchForm extends Form
{
    #[Rule('nullable|min:1|max:255')]
    public ?string $query = null;

    #[Rule('nullable|in:released,longest,shortest')]
    public ?string $sort = null;

    #[Rule('nullable|array|in:caption')]
    public ?array $feature = null;
}
