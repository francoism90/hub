import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\FavoriteController::__invoke
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
const FavoriteController = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: FavoriteController.url(args, options),
    method: 'post',
})

FavoriteController.definition = {
    methods: ['post'],
    url: '/api/v1/videos/{video}/favorite',
}

/**
* @see \App\Api\Videos\Controllers\FavoriteController::__invoke
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
FavoriteController.url = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'prefixed_id' in args) {
        args = { video: args.prefixed_id }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.prefixed_id
        : args.video,
    }

    return FavoriteController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\FavoriteController::__invoke
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
FavoriteController.post = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: FavoriteController.url(args, options),
    method: 'post',
})

export default FavoriteController