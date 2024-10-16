<?php

declare(strict_types=1);

namespace Domain\Videos\Models;

use Domain\Videos\DataObjects\VideoableData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Videoable extends MorphPivot
{
    /**
     * @var string
     */
    protected $table = 'videoables';

    protected function casts(): array
    {
        return [
            'options' => VideoableData::class,
        ];
    }

    public function videoable(): MorphTo
    {
        return $this->MorphTo();
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
