import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\ManifestController::__invoke
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
const ManifestController = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ManifestController.url(args, options),
    method: 'get',
})

ManifestController.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/manifest/{type}',
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::__invoke
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
ManifestController.url = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            video: args[0],
            type: args[1],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.prefixed_id
        : args.video,
        type: args.type,
    }

    return ManifestController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{type}', parsedArgs.type.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::__invoke
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
ManifestController.get = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ManifestController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\ManifestController::__invoke
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
ManifestController.head = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ManifestController.url(args, options),
    method: 'head',
})

export default ManifestController