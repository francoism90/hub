import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Playlists\Controllers\MediaController::__invoke
* @see src/App/Api/Playlists/Controllers/MediaController.php:26
* @route '/api/v1/play/{transcode}/media/{path}'
*/
const MediaController = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: MediaController.url(args, options),
    method: 'get',
})

MediaController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/media/{path}',
}

/**
* @see \App\Api\Playlists\Controllers\MediaController::__invoke
* @see src/App/Api/Playlists/Controllers/MediaController.php:26
* @route '/api/v1/play/{transcode}/media/{path}'
*/
MediaController.url = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            transcode: args[0],
            path: args[1],
        }
    }

    const parsedArgs = {
        transcode: args.transcode,
        path: args.path,
    }

    return MediaController.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Playlists\Controllers\MediaController::__invoke
* @see src/App/Api/Playlists/Controllers/MediaController.php:26
* @route '/api/v1/play/{transcode}/media/{path}'
*/
MediaController.get = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: MediaController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Playlists\Controllers\MediaController::__invoke
* @see src/App/Api/Playlists/Controllers/MediaController.php:26
* @route '/api/v1/play/{transcode}/media/{path}'
*/
MediaController.head = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: MediaController.url(args, options),
    method: 'head',
})

export default MediaController