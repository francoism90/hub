<?php

namespace Foundation\Http\Middlewares;

use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;

class IsPrivateSubnet extends Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(IpUtils::isPrivateIp($request->ip()), 403);

        return $next($request);
    }
}
