import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\EntriesController::destroy
* @see vendor/laravel/telescope/src/Http/Controllers/EntriesController.php:16
* @route '/telescope/telescope-api/entries'
*/
export const destroy = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(options),
    method: 'delete',
})

destroy.definition = {
    methods: ['delete'],
    url: '/telescope/telescope-api/entries',
}

/**
* @see \Laravel\Telescope\Http\Controllers\EntriesController::destroy
* @see vendor/laravel/telescope/src/Http/Controllers/EntriesController.php:16
* @route '/telescope/telescope-api/entries'
*/
destroy.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return destroy.definition.url + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\EntriesController::destroy
* @see vendor/laravel/telescope/src/Http/Controllers/EntriesController.php:16
* @route '/telescope/telescope-api/entries'
*/
destroy.delete = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(options),
    method: 'delete',
})

const EntriesController = { destroy }

export default EntriesController