import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::index
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:33
* @route '/telescope/telescope-api/jobs'
*/
export const index = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: index.url(options),
    method: 'post',
})

index.definition = {
    methods: ['post'],
    url: '/telescope/telescope-api/jobs',
}

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::index
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:33
* @route '/telescope/telescope-api/jobs'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::index
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:33
* @route '/telescope/telescope-api/jobs'
*/
index.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: index.url(options),
    method: 'post',
})

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::show
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:29
* @route '/telescope/telescope-api/jobs/{telescopeEntryId}'
*/
export const show = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/telescope/telescope-api/jobs/{telescopeEntryId}',
}

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::show
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:29
* @route '/telescope/telescope-api/jobs/{telescopeEntryId}'
*/
show.url = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { telescopeEntryId: args }
    }

    if (Array.isArray(args)) {
        args = {
            telescopeEntryId: args[0],
        }
    }

    const parsedArgs = {
        telescopeEntryId: args.telescopeEntryId,
    }

    return show.definition.url
            .replace('{telescopeEntryId}', parsedArgs.telescopeEntryId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::show
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:29
* @route '/telescope/telescope-api/jobs/{telescopeEntryId}'
*/
show.get = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Laravel\Telescope\Http\Controllers\QueueController::show
* @see vendor/laravel/telescope/src/Http/Controllers/QueueController.php:29
* @route '/telescope/telescope-api/jobs/{telescopeEntryId}'
*/
show.head = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

const QueueController = { index, show }

export default QueueController