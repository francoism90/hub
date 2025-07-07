import { queryParams, type QueryParams } from './../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\VideoMediaController::media
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
export const media = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: media.url(args, options),
    method: 'get',
})

media.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/asset/{path}',
}

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::media
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
media.url = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return media.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::media
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
media.get = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: media.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoMediaController::media
* @see src/App/Api/Videos/Controllers/VideoMediaController.php:25
* @route '/api/v1/videos/{video}/asset/{path}'
*/
media.head = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: media.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::playlist
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/videos/{video}/playlist/{path}'
*/
export const playlist = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: playlist.url(args, options),
    method: 'get',
})

playlist.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/playlist/{path}',
}

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::playlist
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/videos/{video}/playlist/{path}'
*/
playlist.url = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return playlist.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{path}', parsedArgs.path.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::playlist
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/videos/{video}/playlist/{path}'
*/
playlist.get = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: playlist.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoPlaylistController::playlist
* @see src/App/Api/Videos/Controllers/VideoPlaylistController.php:26
* @route '/api/v1/videos/{video}/playlist/{path}'
*/
playlist.head = (args: { video: string | { ulid: string }, path: string | number } | [video: string | { ulid: string }, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: playlist.url(args, options),
    method: 'head',
})

const videos = {
    media,
    playlist,
}

export default videos