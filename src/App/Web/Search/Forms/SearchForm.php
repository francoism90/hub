<?php

namespace App\Web\Search\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class SearchForm extends Form
{
    #[Rule('nullable|min:1|max:32')]
    public ?string $query = 'a';

    #[Rule('nullable|in:released,longest,shortest')]
    public ?string $sort = null;
}
