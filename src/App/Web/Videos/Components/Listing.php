<?php

namespace App\Web\Videos\Components;

use App\Web\Search\Forms\SearchForm;
use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithFilters;
use Foxws\LivewireUse\QueryBuilder\Components\QueryBuilder;
use Livewire\WithPagination;

abstract class Listing extends QueryBuilder
{
    use WithFilters;
    use WithPagination;
    use WithTags;

    public SearchForm $form;
}
