import { queryParams, type QueryParams } from './../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
export const manifest = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: manifest.url(args, options),
    method: 'get',
})

manifest.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/manifest/{type}',
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
manifest.url = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            video: args[0],
            type: args[1],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.prefixed_id
        : args.video,
        type: args.type,
    }

    return manifest.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{type}', parsedArgs.type.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
manifest.get = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: manifest.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}'
*/
manifest.head = (args: { video: string | { prefixed_id: string }, type: string | number } | [video: string | { prefixed_id: string }, type: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: manifest.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Videos\Controllers\FavoriteController::favorite
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
export const favorite = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: favorite.url(args, options),
    method: 'post',
})

favorite.definition = {
    methods: ['post'],
    url: '/api/v1/videos/{video}/favorite',
}

/**
* @see \App\Api\Videos\Controllers\FavoriteController::favorite
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
favorite.url = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'prefixed_id' in args) {
        args = { video: args.prefixed_id }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.prefixed_id
        : args.video,
    }

    return favorite.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\FavoriteController::favorite
* @see src/App/Api/Videos/Controllers/FavoriteController.php:26
* @route '/api/v1/videos/{video}/favorite'
*/
favorite.post = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: favorite.url(args, options),
    method: 'post',
})

/**
* @see \App\Api\Videos\Controllers\SaveController::save
* @see src/App/Api/Videos/Controllers/SaveController.php:26
* @route '/api/v1/videos/{video}/save'
*/
export const save = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: save.url(args, options),
    method: 'post',
})

save.definition = {
    methods: ['post'],
    url: '/api/v1/videos/{video}/save',
}

/**
* @see \App\Api\Videos\Controllers\SaveController::save
* @see src/App/Api/Videos/Controllers/SaveController.php:26
* @route '/api/v1/videos/{video}/save'
*/
save.url = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'prefixed_id' in args) {
        args = { video: args.prefixed_id }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.prefixed_id
        : args.video,
    }

    return save.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\SaveController::save
* @see src/App/Api/Videos/Controllers/SaveController.php:26
* @route '/api/v1/videos/{video}/save'
*/
save.post = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: save.url(args, options),
    method: 'post',
})

const videos = {
    manifest,
    favorite,
    save,
}

export default videos