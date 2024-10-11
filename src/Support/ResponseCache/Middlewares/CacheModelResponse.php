<?php

namespace Support\ResponseCache\Middlewares;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Symfony\Component\HttpFoundation\Response;

class CacheModelResponse extends CacheResponse
{
    public function handle(Request $request, Closure $next, ...$args): Response
    {
        $tags = $this->getTagsByModel($request, $args);

        return parent::handle($request, $next, ...$tags);
    }

    protected function getTagsByModel(Request $request, array $args): array
    {
        // Get the first parameter from the route to be used for model binding
        $parameter = Arr::first($args);

        // Check if the parameter is a model and generate a tag for it
        if (($model = $request->route($parameter)) && $model instanceof Model) {
            return ["{$parameter}-{$model->getKey()}"]; // e.g. user-1
        }

        return [];
    }
}
