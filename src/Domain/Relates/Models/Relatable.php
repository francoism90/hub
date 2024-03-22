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
            'score' => 'float',
            'boost' => 'float',
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
