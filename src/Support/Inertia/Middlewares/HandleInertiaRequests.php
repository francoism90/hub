<?php

declare(strict_types=1);

namespace Support\Inertia\Middlewares;

use App\Api\Users\Resources\UserResource;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'layouts/app';

    /**
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'app' => fn () => config('app.name', 'Laravel'),
            'locale' => fn () => app()->currentLocale(),
            'location' => fn () => $request->url(),
            'query' => fn () => $request->query(),
            'flash' => fn () => $this->flash($request),
            'auth.user' => fn () => $this->user($request),
            'auth.login.route' => fn () => route('login'),
            'auth.logout.route' => fn () => route('logout'),
        ]);
    }

    public function flash(Request $request): ?array
    {
        if (! $request->hasSession()) {
            return null;
        }

        return $request->session()->get('laravel_flash_message');
    }

    public function user(Request $request): ?UserResource
    {
        /** @var User $user */
        if (! $user = $request->user()) {
            return null;
        }

        return UserResource::make($user->append('avatar'));
    }

    /**
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }
}
