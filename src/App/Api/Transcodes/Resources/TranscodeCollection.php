<?php

declare(strict_types=1);

namespace App\Api\Transcodes\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TranscodeCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = TranscodeResource::class;

    /**
     * @var bool
     */
    protected $preserveAllQueryParameters = true;
}
