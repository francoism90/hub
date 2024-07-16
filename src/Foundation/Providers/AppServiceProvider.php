<?php

namespace Foundation\Providers;

use Domain\Imports\Models\Import;
use Domain\Media\Models\Media;
use Domain\Playlists\Models\Playlist;
use Domain\Relates\Models\Relatable;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
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
        $this->configureUrlScheme();
        $this->configureStrictness();
        $this->configureMorphMap();
        $this->configurePrefixedIds();
        $this->configureJsonResource();
        $this->configureMacros();
    }

    protected function configureUrlScheme(): void
    {
        URL::forceRootUrl(config('app.url'));
        URL::forceScheme('https');
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
            'relatable' => Relatable::class,
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

    protected function configureMacros(): void
    {
        Collection::macro('options', function (string $label = 'name') {
            /** @var Collection $this */
            return $this->map(fn (Model $item) => [
                'id' => $item->getRouteKey(),
                'name' => $item->getAttribute($label),
            ]);
        });

        Collection::macro('toModels', function () {
            /** @var Collection $this */
            return $this
                ->map(fn (string $item) => PrefixedIds::find($item))
                ->filter();
        });
    }
}
