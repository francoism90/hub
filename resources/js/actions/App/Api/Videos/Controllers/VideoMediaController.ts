import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\VideoMediaController::__invoke
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/play/{video}/media/{path}'
*/
const VideoMediaController = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoMediaController.url(args, options),
    method: 'get',
})

VideoMediaController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{video}/media/{path}',
}

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::__invoke
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/play/{video}/media/{path}'
*/
VideoMediaController.url = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            video: args[0],
            path: args[1],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.ulid
        : args.video,
        path: args.path,
    }

    return VideoMediaController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::__invoke
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/play/{video}/media/{path}'
*/
VideoMediaController.get = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoMediaController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::__invoke
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/play/{video}/media/{path}'
*/
VideoMediaController.head = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: VideoMediaController.url(args, options),
    method: 'head',
})

export default VideoMediaController