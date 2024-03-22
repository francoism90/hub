<?php

namespace Domain\Relates\Models;

use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relatable extends Model
{
    use InteractsWithRandomSeed;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $with = [
        //
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'relate_type',
        'relate_id',
        'score',
        'boost',
        'options',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'boost' => 'decimal:2',
            'options' => AsArrayObject::class,
        ];
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function relate(): MorphTo
    {
        return $this->morphTo();
    }
}
