<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Groups\Models\Group;
use Domain\Groups\Policies\GroupPolicy;
use Domain\Imports\Models\Import;
use Domain\Imports\Policies\ImportPolicy;
use Domain\Media\Models\Media;
use Domain\Media\Policies\MediaPolicy;
use Domain\Tags\Models\Tag;
use Domain\Tags\Policies\TagPolicy;
use Domain\Users\Models\User;
use Domain\Users\Policies\UserPolicy;
use Domain\Videos\Models\Video;
use Domain\Videos\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Group::class => GroupPolicy::class,
        Tag::class => TagPolicy::class,
        Video::class => VideoPolicy::class,
    ];

    public function boot(): void
    {
        $this->configurePasswords();
    }

    protected function configurePasswords(): void
    {
        Password::defaults(fn (): ?Password => app()->isProduction() ? Password::min(12)->max(255)->uncompromised() : null);
    }
}
