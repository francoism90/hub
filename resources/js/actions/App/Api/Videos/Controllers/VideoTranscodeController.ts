import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\VideoTranscodeController::__invoke
* @see src/App/Api/Videos/Controllers/VideoTranscodeController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
const VideoTranscodeController = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoTranscodeController.url(args, options),
    method: 'get',
})

VideoTranscodeController.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/asset/{path}',
}

/**
* @see \App\Api\Videos\Controllers\VideoTranscodeController::__invoke
* @see src/App/Api/Videos/Controllers/VideoTranscodeController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
VideoTranscodeController.url = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return VideoTranscodeController.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoTranscodeController::__invoke
* @see src/App/Api/Videos/Controllers/VideoTranscodeController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
VideoTranscodeController.get = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoTranscodeController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoTranscodeController::__invoke
* @see src/App/Api/Videos/Controllers/VideoTranscodeController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
VideoTranscodeController.head = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: VideoTranscodeController.url(args, options),
    method: 'head',
})

export default VideoTranscodeController