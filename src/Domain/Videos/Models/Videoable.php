<?php

declare(strict_types=1);

namespace Domain\Videos\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;


final class Videoable extends MorphPivot
{
    use Prunable;

    /**
     * @var string
     */
    protected $table = 'videoables';

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
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

    public function prunable(): Builder
    {
        return static::where('updated_at', '<=', now()->subWeek());
    }
}
