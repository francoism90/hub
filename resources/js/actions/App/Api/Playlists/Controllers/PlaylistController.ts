import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{playlist}/playlist/{path}'
*/
const PlaylistController = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistController.url(args, options),
    method: 'get',
})

PlaylistController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{playlist}/playlist/{path}',
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{playlist}/playlist/{path}'
*/
PlaylistController.url = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            playlist: args[0],
            path: args[1],
        }
    }

    const parsedArgs = {
        playlist: typeof args.playlist === 'object'
        ? args.playlist.ulid
        : args.playlist,
        path: args.path,
    }

    return PlaylistController.definition.url
            .replace('{playlist}', parsedArgs.playlist.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{playlist}/playlist/{path}'
*/
PlaylistController.get = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Playlists\Controllers\PlaylistController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistController.php:27
* @route '/api/v1/play/{playlist}/playlist/{path}'
*/
PlaylistController.head = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: PlaylistController.url(args, options),
    method: 'head',
})

export default PlaylistController