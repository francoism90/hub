<?php

namespace Domain\Videos\Models;

use Database\Factories\VideoFactory;
use Domain\Tags\Enums\TagType;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Collections\VideoCollection;
use Domain\Videos\Concerns\InteractsWithCache;
use Domain\Videos\Concerns\InteractsWithPlaylists;
use Domain\Videos\Concerns\InteractsWithVod;
use Domain\Videos\Events\VideoCreated;
use Domain\Videos\Events\VideoDeleted;
use Domain\Videos\Events\VideoSaved;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Domain\Videos\States\VideoState;
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
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasTags;
    use HasTranslatableSlug;
    use HasTranslations;
    use InteractsWithCache;
    use InteractsWithMedia;
    use InteractsWithPlaylists;
    use InteractsWithUser;
    use InteractsWithVod;
    use LogsActivity;
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
        //
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'state' => VideoState::class,
        'snapshot' => 'decimal:2',
        'released_at' => 'date:Y-m-d',
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

    /**
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        'created' => VideoCreated::class,
        'saved' => VideoSaved::class,
        'deleted' => VideoDeleted::class,
    ];

    protected static function newFactory(): VideoFactory
    {
        return VideoFactory::new();
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

    public function searchableAs(): string
    {
        return 'videos';
    }

    public function makeSearchableUsing(VideoCollection $models): VideoCollection
    {
        return $models->loadMissing($this->with);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
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

    public function placeholder(): Attribute
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

    public function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->released_at ?: $this->created_at
        )->shouldCache();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getScoutKey(),
            'name' => $this->name,
            'identifier' => $this->identifier,
            'content' => $this->content,
            'summary' => $this->summary,
            'adult' => $this->adult,
            'duration' => $this->duration,
            'caption' => $this->caption,
            'studios' => $this->tags->type(TagType::studio())->seo(),
            'people' => $this->tags->type(TagType::person())->seo(),
            'genres' => $this->tags->type(TagType::genre())->seo(),
            'languages' => $this->tags->type(TagType::language())->seo(),
            'state' => $this->state,
            'released_at' => $this->released_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    protected function makeAllSearchableUsing(VideoQueryBuilder $query): VideoQueryBuilder
    {
        return $query->with($this->with);
    }
}
