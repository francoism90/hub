import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
const PlaylistController = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistController.url(args, options),
    method: 'get',
})

PlaylistController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{transcode}/playlist/{path}',
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
PlaylistController.url = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return PlaylistController.definition.url
            .replace('{transcode}', parsedArgs.transcode.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
PlaylistController.get = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{transcode}/playlist/{path}'
*/
PlaylistController.head = (args: { transcode: string | number, path: string | number } | [transcode: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: PlaylistController.url(args, options),
    method: 'head',
})

export default PlaylistController