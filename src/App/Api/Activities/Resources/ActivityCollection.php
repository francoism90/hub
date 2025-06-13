<?php

declare(strict_types=1);

namespace App\Api\Activities\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = ActivityResource::class;
}
