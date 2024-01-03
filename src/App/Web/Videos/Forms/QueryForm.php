<?php

namespace App\Web\Videos\Forms;

use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\Forms\Concerns\WithTag;

class QueryForm extends Form
{
    use WithSearch;
    use WithSorts;
    use WithTag;

    protected static bool $recoverable = true;
}
