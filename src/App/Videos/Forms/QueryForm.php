<?php

namespace App\Videos\Forms;

use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\Forms\Concerns\WithTags;
use Foxws\LivewireUse\Forms\Support\Form;

class QueryForm extends Form
{
    use WithSearch;
    use WithSorts;
    use WithTags;
}
