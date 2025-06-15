<?php

declare(strict_types=1);

namespace App\Api\Authentication\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = PermissionResource::class;
}
