import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\RecordingController::toggle
* @see vendor/laravel/telescope/src/Http/Controllers/RecordingController.php:33
* @route '/telescope/telescope-api/toggle-recording'
*/
export const toggle = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: toggle.url(options),
    method: 'post',
})

toggle.definition = {
    methods: ['post'],
    url: '/telescope/telescope-api/toggle-recording',
}

/**
* @see \Laravel\Telescope\Http\Controllers\RecordingController::toggle
* @see vendor/laravel/telescope/src/Http/Controllers/RecordingController.php:33
* @route '/telescope/telescope-api/toggle-recording'
*/
toggle.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return toggle.definition.url + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\RecordingController::toggle
* @see vendor/laravel/telescope/src/Http/Controllers/RecordingController.php:33
* @route '/telescope/telescope-api/toggle-recording'
*/
toggle.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: toggle.url(options),
    method: 'post',
})

const RecordingController = { toggle }

export default RecordingController