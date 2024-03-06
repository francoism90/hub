<?php

namespace App\Search\Forms;

use Foxws\LivewireUse\Forms\Concerns\WithFeatures;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\Forms\Support\Form;

class QueryForm extends Form
{
    use WithFeatures;
    use WithSearch;
    use WithSorts;

    protected static bool $store = true;
}
