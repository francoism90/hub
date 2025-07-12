import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::index
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:33
* @route '/telescope/telescope-api/exceptions'
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
    url: '/telescope/telescope-api/exceptions',
}

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::index
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:33
* @route '/telescope/telescope-api/exceptions'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::index
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:33
* @route '/telescope/telescope-api/exceptions'
*/
index.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: index.url(options),
    method: 'post',
})

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::show
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:51
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
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
    url: '/telescope/telescope-api/exceptions/{telescopeEntryId}',
}

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::show
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:51
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
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
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::show
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:51
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
*/
show.get = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::show
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:51
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
*/
show.head = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::update
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:42
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
*/
export const update = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ['put'],
    url: '/telescope/telescope-api/exceptions/{telescopeEntryId}',
}

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::update
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:42
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
*/
update.url = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return update.definition.url
            .replace('{telescopeEntryId}', parsedArgs.telescopeEntryId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\ExceptionController::update
* @see vendor/laravel/telescope/src/Http/Controllers/ExceptionController.php:42
* @route '/telescope/telescope-api/exceptions/{telescopeEntryId}'
*/
update.put = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

const ExceptionController = { index, show, update }

export default ExceptionController