import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
const TranscodeMediaController = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TranscodeMediaController.url(args, options),
    method: 'get',
})

TranscodeMediaController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/media/{path}',
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
TranscodeMediaController.url = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return TranscodeMediaController.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
TranscodeMediaController.get = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TranscodeMediaController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::__invoke
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
TranscodeMediaController.head = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: TranscodeMediaController.url(args, options),
    method: 'head',
})

export default TranscodeMediaController