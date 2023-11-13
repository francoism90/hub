<?php

namespace Foundation\Providers;

use Domain\Imports\Models\Import;
use Domain\Media\Models\Media;
use Domain\Playlists\Models\Playlist;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\PrefixedIds\PrefixedIds;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureStrictness();
        $this->configureMorphMap();
        $this->configureJsonResource();
        $this->configurePrefixedIds();
    }

    protected function configureStrictness(): void
    {
        Model::shouldBeStrict(! $this->app->environment('production'));
    }

    protected function configureMorphMap(): void
    {
        Relation::enforceMorphMap([
            'import' => Import::class,
            'media' => Media::class,
            'playlist' => Playlist::class,
            'tag' => Tag::class,
            'user' => User::class,
            'video' => Video::class,
        ]);
    }

    protected function configurePrefixedIds(): void
    {
        PrefixedIds::generateUniqueIdUsing(fn () => Str::random(10));

        PrefixedIds::registerModels([
            'playlist-' => Playlist::class,
            'tag-' => Tag::class,
            'user-' => User::class,
            'video-' => Video::class,
        ]);
    }

    protected function configureJsonResource(): void
    {
        JsonResource::withoutWrapping();
    }
}
