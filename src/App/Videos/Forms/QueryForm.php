<?php

namespace App\Videos\Forms;

use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\Forms\Concerns\WithTags;

class QueryForm extends Form
{
    use WithSearch;
    use WithSorts;
    use WithTags;
}
