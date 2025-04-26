<?php

declare(strict_types=1);

namespace Domain\Activities\Models;

use Domain\Activities\Collections\ActivityCollection;
use Domain\Activities\Enums\ActivityType;
use Domain\Activities\QueryBuilders\ActivityQueryBuilder;
use Domain\Users\Concerns\InteractsWithUser;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class Activity extends Model
{
    use BroadcastsEvents;
    use HasFactory;
    use HasPrefixedId;
    use InteractsWithUser;
    use Searchable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'user_id',
        'name',
        'options',
        'type',
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
            'options' => AsArrayObject::class,
            'type' => ActivityType::class,
        ];
    }

    public function newEloquentBuilder($query): ActivityQueryBuilder
    {
        return new ActivityQueryBuilder($query);
    }

    public function newCollection(array $models = []): ActivityCollection
    {
        return new ActivityCollection($models);
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(string $event): array
    {
        if ($event === 'deleted') {
            return [];
        }

        return [
            new PrivateChannel('user.'.$this->user->getRouteKey()),
        ];
    }

    public function broadcastAs(string $event): ?string
    {
        return str($event)
            ->prepend('activity.')
            ->trim('.')
            ->value();
    }

    public function broadcastWith(string $event): array
    {
        return ['id' => $this->getRouteKey()];
    }

    public function broadcastQueue(): string
    {
        return 'broadcasts';
    }

    public function broadcastAfterCommit(): bool
    {
        return true;
    }

    public function makeSearchableUsing(ActivityCollection $models): ActivityCollection
    {
        return $models->loadMissing('user');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->getScoutKey(),
            'created_at' => (int) $this->created_at->getTimestamp(),
            'updated_at' => (int) $this->updated_at->getTimestamp(),
        ];
    }
}
