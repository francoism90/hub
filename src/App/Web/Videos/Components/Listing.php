<?php

namespace App\Web\Videos\Components;

use App\Web\Search\Forms\QueryForm;
use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithFilters;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Components\QueryBuilder;
use Livewire\WithPagination;

abstract class Listing extends QueryBuilder
{
    use WithFilters;
    use WithPagination;
    use WithTags;

    protected static string $model = Video::class;

    public QueryForm $form;
}
