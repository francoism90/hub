<?php

declare(strict_types=1);

namespace Domain\Videos\Models;

use Database\Factories\VideoFactory;
use Domain\Groups\Concerns\InteractsWithGroups;
use Domain\Tags\Concerns\HasTags;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Users\Models\User;
use Domain\Videos\Collections\VideoCollection;
use Domain\Videos\Concerns\InteractsWithCache;
use Domain\Videos\Concerns\InteractsWithVod;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Domain\Videos\States\VideoState;
use Foxws\ModelCache\Concerns\InteractsWithModelCache;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use BroadcastsEvents;
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasTags;
    use HasTranslations;
    use InteractsWithCache;
    use InteractsWithGroups;
    use InteractsWithMedia;
    use InteractsWithModelCache;
    use InteractsWithUser;
    use InteractsWithVod;
    use Searchable;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $with = [
        'media',
        'tags',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'titles',
        'content',
        'summary',
        'season',
        'episode',
        'part',
        'adult',
        'snapshot',
        'state',
        'released_at',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @var array<int, string>
     */
    protected $translatable = [
        'name',
        'titles',
        'content',
        'summary',
    ];

    protected static function newFactory(): VideoFactory
    {
        return VideoFactory::new();
    }

    protected function casts(): array
    {
        return [
            'state' => VideoState::class,
            'snapshot' => 'decimal:2',
            'released_at' => 'date:Y-m-d',
        ];
    }

    public function newEloquentBuilder($query): VideoQueryBuilder
    {
        return new VideoQueryBuilder($query);
    }

    public function newCollection(array $models = []): VideoCollection
    {
        return new VideoCollection($models);
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('clips')
            ->useDisk('media')
            ->storeConversionsOnDisk('conversions')
            ->acceptsMimeTypes([
                'video/av1',
                'video/mp4',
                'video/mp4v-es',
                'video/ogg',
                'video/quicktime',
                'video/webm',
                'video/x-m4v',
                'video/x-matroska',
            ]);

        $this
            ->addMediaCollection('captions')
            ->useDisk('media')
            ->storeConversionsOnDisk('conversions')
            ->acceptsMimeTypes([
                'text/plain',
                'text/vtt',
            ]);

        $this
            ->addMediaCollection('previews')
            ->useDisk('conversions')
            ->storeConversionsOnDisk('conversions')
            ->singleFile()
            ->acceptsMimeTypes([
                'video/av1',
                'video/mp4',
                'video/mp4v-es',
                'video/ogg',
                'video/quicktime',
                'video/webm',
                'video/x-m4v',
                'video/x-matroska',
            ]);

        $this
            ->addMediaCollection('thumbnail')
            ->useDisk('conversions')
            ->storeConversionsOnDisk('conversions')
            ->singleFile()
            ->withResponsiveImages()
            ->acceptsMimeTypes([
                'image/avif',
                'image/jpg',
                'image/jpeg',
                'image/png',
                'image/webp',
            ]);
    }

    public function isFavorited(?User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return $user
            ->groups()
            ->favorites()
            ->whereRelation('videos', 'id', $this->getKey())
            ->exists();
    }

    public function isWatchlisted(?User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return $user
            ->groups()
            ->saves()
            ->whereRelation('videos', 'id', $this->getKey())
            ->exists();
    }

    public function isViewed(?User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return $user
            ->groups()
            ->views()
            ->whereRelation('videos', 'id', $this->getKey())
            ->exists();
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
            new PrivateChannel('video.'.$this->getRouteKey()),
        ];
    }

    public function broadcastAs(string $event): ?string
    {
        return str($event)
            ->prepend('video.')
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

    public function makeSearchableUsing(VideoCollection $models): VideoCollection
    {
        return $models->loadMissing('media', 'tags');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->getScoutKey(),
            'identifier' => (string) $this->identifier,
            'name' => (string) $this->name,
            'title' => (string) $this->title,
            'season' => (string) str($this->season)->ltrim('0'),
            'episode' => (string) str($this->episode)->ltrim('0'),
            'part' => (string) str($this->part)->ltrim('0'),
            'content' => (string) $this->content,
            'summary' => (string) $this->summary,
            'duration' => (float) $this->duration,
            'caption' => (bool) $this->caption,
            'released' => (string) $this->released,
            'adult' => (bool) $this->adult,
            'tags' => (string) $this->tags_translated,
            'relatables' => (string) $this->tags_related,
            'tagged' => (array) $this->tags->modelKeys(),
            'state' => (string) $this->state,
            'created_at' => (int) $this->created_at->getTimestamp(),
            'updated_at' => (int) $this->updated_at->getTimestamp(),
        ];
    }

    protected function makeAllSearchableUsing(VideoQueryBuilder $query): VideoQueryBuilder
    {
        return $query->with(['media', 'tags']);
    }

    public function identifier(): Attribute
    {
        return Attribute::make(
            get: fn () => implode('-', array_filter([$this->season, $this->episode, $this->part]))
        )->shouldCache();
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(' - ', array_filter([$this->name, $this->part]))
        )->shouldCache();
    }

    public function srcset(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('thumbnail')?->getSrcset()
        )->shouldCache();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('thumbnail')
        )->shouldCache();
    }

    public function released(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->released_at?->toDateString()
        )->shouldCache();
    }

    public function published(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->released_at ?: $this->created_at
        )->shouldCache();
    }
}
