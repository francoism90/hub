<?php

namespace Domain\Videos\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Database\Factories\VideoFactory;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Shared\Concerns\InteractsWithViews;
use Domain\Tags\Enums\TagType;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Collections\VideoCollection;
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
use Illuminate\Notifications\Notifiable;
use Kirschbaum\PowerJoins\PowerJoins;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelFollow\Traits\Followable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia, Viewable
{
    use InteractsWithMedia;
    use InteractsWithPlaylists;
    use InteractsWithRandomSeed;
    use InteractsWithUser;
    use InteractsWithViews;
    use InteractsWithVod;
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasTags;
    use HasTranslatableSlug;
    use HasTranslations;
    use Favoriteable;
    use Followable;
    use Notifiable;
    use PowerJoins;
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
        'titles',
        'content',
        'summary',
        'season',
        'episode',
        'adult',
        'snapshot',
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
        'snapshot' => 'float',
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
            ->addMediaCollection('previews')
            ->useDisk('conversions')
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

    protected function makeAllSearchableUsing(VideoQueryBuilder $query): VideoQueryBuilder
    {
        return $query->with('tags');
    }

    public function makeSearchableUsing(VideoCollection $models): VideoCollection
    {
        return $models->loadMissing('tags');
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
            'titles' => $this->titles,
            'season' => $this->season,
            'episode' => $this->episode,
            'content' => $this->content,
            'summary' => $this->summary,
            'adult' => $this->adult,
            'studios' => $this->tags->type(TagType::studio())->seo(),
            'genres' => $this->tags->type(TagType::genre())->seo(),
            'languages' => $this->tags->type(TagType::language())->seo(),
            'people' => $this->tags->type(TagType::person())->seo(),
            'released_at' => $this->released_at,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
