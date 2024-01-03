<?php

namespace App\Web\Videos\Forms;

use App\Web\Forms\Concerns\WithTag;
use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;

class QueryForm extends Form
{
    use WithSearch;
    use WithSorts;
    use WithTag;
}
