import { queryParams, type QueryParams } from './../../../wayfinder'
/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::media
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
export const media = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: media.url(args, options),
    method: 'get',
})

media.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/media/{path}',
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::media
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
media.url = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return media.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::media
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
media.get = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: media.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Transcodes\Controllers\TranscodeMediaController::media
* @see src/App/Api/Transcodes/Controllers/TranscodeMediaController.php:25
* @route '/api/v1/play/{transcode}/media/{path}'
*/
media.head = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: media.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::playlist
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
export const playlist = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: playlist.url(args, options),
    method: 'get',
})

playlist.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/playlist/{path}',
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::playlist
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
playlist.url = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return playlist.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::playlist
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
playlist.get = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: playlist.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Transcodes\Controllers\TranscodePlaylistController::playlist
* @see src/App/Api/Transcodes/Controllers/TranscodePlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
playlist.head = (args: { transcode: string | { ulid: string }, path: string | number } | [transcode: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: playlist.url(args, options),
    method: 'head',
})

const transcodes = {
    media,
    playlist,
}

export default transcodes