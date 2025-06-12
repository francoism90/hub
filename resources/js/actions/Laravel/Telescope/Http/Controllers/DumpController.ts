import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\DumpController::index
* @see vendor/laravel/telescope/src/Http/Controllers/DumpController.php:42
* @route '/telescope/telescope-api/dumps'
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
    url: '/telescope/telescope-api/dumps',
}

/**
* @see \Laravel\Telescope\Http\Controllers\DumpController::index
* @see vendor/laravel/telescope/src/Http/Controllers/DumpController.php:42
* @route '/telescope/telescope-api/dumps'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\DumpController::index
* @see vendor/laravel/telescope/src/Http/Controllers/DumpController.php:42
* @route '/telescope/telescope-api/dumps'
*/
index.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: index.url(options),
    method: 'post',
})

const DumpController = { index }

export default DumpController