import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\SaveController::__invoke
* @see src/App/Api/Videos/Controllers/SaveController.php:28
* @route '/api/v1/videos/{video}/save'
*/
const SaveController = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: SaveController.url(args, options),
    method: 'post',
})

SaveController.definition = {
    methods: ['post'],
    url: '/api/v1/videos/{video}/save',
}

/**
* @see \App\Api\Videos\Controllers\SaveController::__invoke
* @see src/App/Api/Videos/Controllers/SaveController.php:28
* @route '/api/v1/videos/{video}/save'
*/
SaveController.url = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return SaveController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\SaveController::__invoke
* @see src/App/Api/Videos/Controllers/SaveController.php:28
* @route '/api/v1/videos/{video}/save'
*/
SaveController.post = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: SaveController.url(args, options),
    method: 'post',
})

export default SaveController