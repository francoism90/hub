<?php

namespace Domain\Imports\Models;

use Database\Factories\ImportFactory;
use Domain\Imports\Enums\ImportType;
use Domain\Imports\QueryBuilders\ImportQueryBuilder;
use Domain\Imports\States\ImportState;
use Domain\Users\Concerns\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\ModelStates\HasStates;

class Import extends Model
{
    use InteractsWithUser;
    use HasFactory;
    use HasStates;
    use Notifiable;

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
        'file_name',
        'mime_type',
        'size',
        'type',
        'finished_at',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'state' => ImportState::class,
        'type' => ImportType::class,
        'finished_at' => 'datetime',
    ];

    /**
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        //
    ];

    protected static function newFactory(): ImportFactory
    {
        return ImportFactory::new();
    }

    public function newEloquentBuilder($query): ImportQueryBuilder
    {
        return new ImportQueryBuilder($query);
    }
}
