<?php

namespace Domain\Playlists\Models;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\QueryBuilders\PlaylistQueryBuilder;
use Domain\Playlists\States\PlaylistState;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Concerns\HasVideos;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class Playlist extends Model implements HasMedia
{
    use BroadcastsEvents;
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasVideos;
    use InteractsWithMedia;
    use InteractsWithUser;
    use LogsActivity;
    use Notifiable;
    use Searchable;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'content',
        'type',
        'order_column',
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
            'state' => PlaylistState::class,
            'type' => PlaylistType::class,
        ];
    }

    public function newEloquentBuilder($query): PlaylistQueryBuilder
    {
        return new PlaylistQueryBuilder($query);
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function searchableAs(): string
    {
        return 'playlists';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getScoutKey(),
            'name' => $this->name,
            'content' => $this->content,
            'type' => $this->type,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn($event): array
    {
        return [
            new PrivateChannel('user.'.$this->user->getRouteKey()),
            new PrivateChannel('playlist.'.$this->getRouteKey()),
        ];
    }

    public function broadcastAs(string $event): ?string
    {
        return str($event)
            ->prepend('playlist.')
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
}
