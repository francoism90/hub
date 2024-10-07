<?php

namespace Foundation\Http\Middlewares;

use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;

class EnsureRequestHasPrivateSubnet extends Middleware
{
    public function handle(Request $request, Closure $next, ?string $redirectToRoute = null): Response|RedirectResponse
    {
        $isPrivateIp = IpUtils::isPrivateIp($request->ip());

        if ($isPrivateIp) {
            return $next($request);
        }

        return $request->expectsJson()
            ? abort(403, 'Unauthorized')
            : Redirect::guest(URL::route($redirectToRoute ?: 'home'));
    }
}
