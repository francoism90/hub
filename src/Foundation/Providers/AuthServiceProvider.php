<?php

namespace Foundation\Providers;

use Domain\Imports\Models\Import;
use Domain\Imports\Policies\ImportPolicy;
use Domain\Media\Models\Media;
use Domain\Media\Policies\MediaPolicy;
use Domain\Playlists\Models\Playlist;
use Domain\Playlists\Policies\PlaylistPolicy;
use Domain\Tags\Models\Tag;
use Domain\Tags\Policies\TagPolicy;
use Domain\Users\Models\User;
use Domain\Users\Policies\UserPolicy;
use Domain\Videos\Models\Video;
use Domain\Videos\Models\Videoable;
use Domain\Videos\Policies\VideoablePolicy;
use Domain\Videos\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Import::class => ImportPolicy::class,
        Media::class => MediaPolicy::class,
        Playlist::class => PlaylistPolicy::class,
        Tag::class => TagPolicy::class,
        Video::class => VideoPolicy::class,
        Videoable::class => VideoablePolicy::class,
    ];
}
