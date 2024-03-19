<?php

namespace Domain\Imports\Models;

use Database\Factories\ImportFactory;
use Domain\Imports\QueryBuilders\ImportQueryBuilder;
use Domain\Imports\States\ImportState;
use Domain\Users\Concerns\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Notifications\Notifiable;
use Spatie\ModelStates\HasStates;

class Import extends Model
{
    use HasFactory;
    use HasStates;
    use InteractsWithUser;
    use Notifiable;
    use Prunable;

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
        'name',
        'mime_type',
        'size',
        'finished_at',
        'state',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    protected static function newFactory(): ImportFactory
    {
        return ImportFactory::new();
    }

    protected function casts(): array
    {
        return [
            'state' => ImportState::class,
            'finished_at' => 'datetime',
        ];
    }

    public function newEloquentBuilder($query): ImportQueryBuilder
    {
        return new ImportQueryBuilder($query);
    }

    public function prunable(): ImportQueryBuilder
    {
        return static::where('created_at', '<=', now()->subMonth());
    }
}
