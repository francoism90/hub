<?php

namespace Domain\Videos\Models;

use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Users\Concerns\InteractsWithUser;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relatable extends Model
{
    use InteractsWithRandomSeed;
    use InteractsWithUser;
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
        'user_id',
        'options',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
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
