<?php

namespace App\Web\Search\Forms;

use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    use WithSearch;
    use WithSorts;

    #[Validate('nullable|array|in:caption')]
    public ?array $feature = null;
}
