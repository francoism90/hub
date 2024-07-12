<?php

namespace Domain\Videos\Models;

use Database\Factories\VideoFactory;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Tags\Concerns\HasTags;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Collections\VideoCollection;
use Domain\Videos\Concerns\InteractsWithPlaylists;
use Domain\Videos\Concerns\InteractsWithVod;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Domain\Videos\States\VideoState;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use BroadcastsEvents;
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasTags;
    use HasTranslatableSlug;
    use HasTranslations;
    use InteractsWithMedia;
    use InteractsWithPlaylists;
    use InteractsWithRandomSeed;
    use InteractsWithUser;
    use InteractsWithVod;
    use LogsActivity;
    use Searchable;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $with = [
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
        'slug',
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('clips')
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
            ->useDisk('conversions')
            ->acceptsMimeTypes([
                'text/plain',
                'text/vtt',
            ]);

        $this
            ->addMediaCollection('previews')
            ->useDisk('conversions')
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

    public function searchableAs(): string
    {
        return 'videos';
    }

    public function makeSearchableUsing(VideoCollection $models): VideoCollection
    {
        return $models->loadMissing($this->with);
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

    public function responsive(): Attribute
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

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->getScoutKey(),
            'name' => (string) $this->name,
            'identifier' => (string) $this->identifier,
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
        return $query->with($this->with);
    }
}
