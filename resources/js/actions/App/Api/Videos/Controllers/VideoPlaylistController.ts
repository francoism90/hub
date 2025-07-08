import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::__invoke
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/play/{video}/playlist/{path}'
*/
const VideoPlaylistController = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoPlaylistController.url(args, options),
    method: 'get',
})

VideoPlaylistController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{video}/playlist/{path}',
}

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::__invoke
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/play/{video}/playlist/{path}'
*/
VideoPlaylistController.url = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return VideoPlaylistController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::__invoke
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/play/{video}/playlist/{path}'
*/
VideoPlaylistController.get = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoPlaylistController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::__invoke
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/play/{video}/playlist/{path}'
*/
VideoPlaylistController.head = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: VideoPlaylistController.url(args, options),
    method: 'head',
})

export default VideoPlaylistController