<?php

namespace Domain\Tags\Models;

use Database\Factories\TagFactory;
use Domain\Relates\Concerns\HasRelated;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\QueryBuilders\TagQueryBuilder;
use Domain\Videos\Models\Video;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag implements HasMedia
{
    use BroadcastsEvents;
    use HasFactory;
    use HasPrefixedId;
    use HasRelated;
    use InteractsWithMedia;
    use InteractsWithRandomSeed;
    use LogsActivity;
    use Searchable;

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
        'name',
        'description',
        'type',
        'adult',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }

    protected function casts(): array
    {
        return [
            'type' => TagType::class,
        ];
    }

    public function newEloquentBuilder($query): TagQueryBuilder
    {
        return new TagQueryBuilder($query);
    }

    public function newCollection(array $models = []): TagCollection
    {
        return new TagCollection($models);
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

    public function registerMediaCollections(): void
    {
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
            new PrivateChannel('tag.'.$this->getRouteKey()),
        ];
    }

    public function broadcastAs(string $event): ?string
    {
        return str($event)
            ->prepend('tag.')
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
        return 'tags';
    }

    public function makeSearchableUsing(TagCollection $models): TagCollection
    {
        return $models->loadMissing($this->with);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->getScoutKey(),
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'type' => (string) $this->type->value,
            'adult' => (bool) $this->adult,
            'created_at' => (int) $this->created_at->getTimestamp(),
            'updated_at' => (int) $this->updated_at->getTimestamp(),
        ];
    }

    protected function makeAllSearchableUsing(TagQueryBuilder $query): TagQueryBuilder
    {
        return $query->with($this->with);
    }

    protected function relates(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->relatables()
                ->whereHasMorph('relate', static::class)
                ->scores()
                ->get()
                ->relates()
        )->shouldCache();
    }
}
