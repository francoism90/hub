import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
const TranscodePlaylistController = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TranscodePlaylistController.url(args, options),
    method: 'get',
})

TranscodePlaylistController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/playlist/{path}',
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
TranscodePlaylistController.url = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            transcode: args[0],
            path: args[1],
        }
    }

    const parsedArgs = {
        transcode: typeof args.transcode === 'object'
        ? args.transcode.ulid
        : args.transcode,
        path: args.path,
    }

    return TranscodePlaylistController.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
TranscodePlaylistController.get = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TranscodePlaylistController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
TranscodePlaylistController.head = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: TranscodePlaylistController.url(args, options),
    method: 'head',
})

export default TranscodePlaylistController