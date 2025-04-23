<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Activities\Models\Activity;
use Domain\Groups\Models\Group;
use Domain\Imports\Models\Import;
use Domain\Media\Models\Media;
use Domain\Relates\Models\Relatable;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\PrefixedIds\PrefixedIds;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureUrls();
        $this->configureModels();
        $this->configureMorphMap();
        $this->configurePrefixedIds();
        $this->configureCommands();
        $this->configureJsonResource();
        $this->configureMacros();
    }

    protected function configureUrls(): void
    {
        URL::forceRootUrl(config('app.url'));
        URL::forceHttps();
    }

    protected function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();
        Model::shouldBeStrict();
    }

    protected function configureMorphMap(): void
    {
        Relation::enforceMorphMap([
            'activity' => Activity::class,
            'import' => Import::class,
            'media' => Media::class,
            'group' => Group::class,
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
            'activity-' => Activity::class,
            'list-' => Group::class,
            'tag-' => Tag::class,
            'user-' => User::class,
            'video-' => Video::class,
        ]);
    }

    protected function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->environment('production')
        );
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
