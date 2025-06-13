<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Database\Factories\UserFactory;
use Domain\Activities\Concerns\InteractsWithActivities;
use Domain\Media\Concerns\InteractsWithMedia;
use Domain\Users\Collections\UserCollection;
use Domain\Users\Concerns\InteractsWithCache;
use Domain\Users\Concerns\InteractsWithGroups;
use Domain\Users\QueryBuilders\UserQueryBuilder;
use Domain\Users\States\UserState;
use Domain\Videos\Concerns\InteractsWithVideos;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use BroadcastsEvents;
    use HasApiTokens;
    use HasFactory;
    use HasPrefixedId;
    use HasRoles;
    use HasStates;
    use InteractsWithActivities;
    use InteractsWithCache;
    use InteractsWithGroups;
    use InteractsWithMedia;
    use InteractsWithVideos;
    use Notifiable;
    use Searchable;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'state' => UserState::class,
        ];
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }

    public function guardName(): array
    {
        return ['api', 'web'];
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
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

    /**
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(string $event): array
    {
        if ($event === 'deleted') {
            return [];
        }

        return [
            new PrivateChannel('user.'.$this->getRouteKey()),
        ];
    }

    public function broadcastAs(string $event): ?string
    {
        return str($event)
            ->prepend('user.')
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

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'user.'.$this->getRouteKey();
    }

    public function makeSearchableUsing(UserCollection $models): UserCollection
    {
        return $models->loadMissing($this->with);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->getScoutKey(),
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'state' => (string) $this->state,
            'created' => (int) $this->created_at->getTimestamp(),
            'updated' => (int) $this->updated_at->getTimestamp(),
        ];
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('avatar')
        )->shouldCache();
    }
}
