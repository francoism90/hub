import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Playlists\Controllers\PlaylistMediaController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistMediaController.php:26
* @route '/api/v1/play/{playlist}/media/{path}'
*/
const PlaylistMediaController = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistMediaController.url(args, options),
    method: 'get',
})

PlaylistMediaController.definition = {
    methods: ['get','head'],
    url: '/api/v1/play/{playlist}/media/{path}',
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistMediaController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistMediaController.php:26
* @route '/api/v1/play/{playlist}/media/{path}'
*/
PlaylistMediaController.url = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return PlaylistMediaController.definition.url
            .replace('{playlist}', parsedArgs.playlist.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Playlists\Controllers\PlaylistMediaController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistMediaController.php:26
* @route '/api/v1/play/{playlist}/media/{path}'
*/
PlaylistMediaController.get = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PlaylistMediaController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Playlists\Controllers\PlaylistMediaController::__invoke
* @see src/App/Api/Playlists/Controllers/PlaylistMediaController.php:26
* @route '/api/v1/play/{playlist}/media/{path}'
*/
PlaylistMediaController.head = (args: { playlist: string | { ulid: string }, path: string | number } | [playlist: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: PlaylistMediaController.url(args, options),
    method: 'head',
})

export default PlaylistMediaController