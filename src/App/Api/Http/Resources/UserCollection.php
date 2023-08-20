<?php

namespace App\Api\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = UserResource::class;
}
