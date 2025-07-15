import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Playlists\Controllers\PlaylistKeyController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistKeyController.php:26
* @route '/api/v1/play/{playlist}/key/{path}'
*/
const PlaylistKeyController = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistKeyController.url(args, options),
    method: 'get',
})

PlaylistKeyController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{playlist}/key/{path}',
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistKeyController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistKeyController.php:26
* @route '/api/v1/play/{playlist}/key/{path}'
*/
PlaylistKeyController.url = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return PlaylistKeyController.definition.url
            .replace('{playlist}', parsedArgs.playlist.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistKeyController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistKeyController.php:26
* @route '/api/v1/play/{playlist}/key/{path}'
*/
PlaylistKeyController.get = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistKeyController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Playlists\Controllers\PlaylistKeyController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistKeyController.php:26
* @route '/api/v1/play/{playlist}/key/{path}'
*/
PlaylistKeyController.head = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: PlaylistKeyController.url(args, options),
    method: 'head',
})

export default PlaylistKeyController