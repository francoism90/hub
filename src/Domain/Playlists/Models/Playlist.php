<?php

namespace Domain\Playlists\Models;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\QueryBuilders\PlaylistQueryBuilder;
use Domain\Playlists\States\PlaylistState;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Concerns\HasVideos;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class Playlist extends Model implements HasMedia
{
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasVideos;
    use InteractsWithMedia;
    use InteractsWithRandomSeed;
    use InteractsWithUser;
    use Notifiable;
    use Searchable;
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
        'name',
        'content',
        'type',
        'order_column',
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
        'state' => PlaylistState::class,
        'type' => PlaylistType::class.':nullable',
    ];

    /**
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        // 'created' => VideoCreated::class,
        // 'saved' => VideoSaved::class,
        // 'deleted' => VideoDeleted::class,
    ];

    // protected static function newFactory(): VideoFactory
    // {
    //     return VideoFactory::new();
    // }

    public function newEloquentBuilder($query): PlaylistQueryBuilder
    {
        return new PlaylistQueryBuilder($query);
    }

    // public function newCollection(array $models = []): VideoCollection
    // {
    //     return new VideoCollection($models);
    // }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function searchableAs(): string
    {
        return 'playlists';
    }

    public function placeholder(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('thumbnail')?->getSrcset()
        )->shouldCache();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => route('api.videos.thumbnail', $this)
        )->shouldCache();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getScoutKey(),
            'name' => $this->name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
