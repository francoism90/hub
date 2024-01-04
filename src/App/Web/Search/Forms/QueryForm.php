<?php

namespace App\Web\Search\Forms;

use Foxws\LivewireUse\Forms\Components\Form;
use Foxws\LivewireUse\Forms\Concerns\WithFeatures;
use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\Forms\Concerns\WithTags;

class QueryForm extends Form
{
    use WithFeatures;
    use WithSearch;
    use WithSorts;
    use WithTags;

    protected static bool $store = true;
}
