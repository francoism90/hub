<?php

namespace Domain\Users\Models;

use Database\Factories\UserFactory;
use Domain\Playlists\Concerns\InteractsWithPlaylists;
use Domain\Users\Collections\UserCollection;
use Domain\Users\Concerns\InteractsWithCache;
use Domain\Users\Concerns\InteractsWithFilament;
use Domain\Users\QueryBuilders\UserQueryBuilder;
use Domain\Users\States\UserState;
use Domain\Videos\Concerns\InteractsWithVideos;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class User extends Authenticatable implements FilamentUser, HasMedia, MustVerifyEmail
{
    use InteractsWithCache;
    use InteractsWithFilament;
    use InteractsWithMedia;
    use InteractsWithPlaylists;
    use InteractsWithVideos;
    use HasApiTokens;
    use HasFactory;
    use HasPrefixedId;
    use HasRoles;
    use HasStates;
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

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'state' => UserState::class,
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
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
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/svg'])
            ->singleFile();
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'user.'.$this->getRouteKey();
    }

    public function searchableAs(): string
    {
        return 'users';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getScoutKey(),
            'name' => $this->name,
            'email' => $this->email,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
