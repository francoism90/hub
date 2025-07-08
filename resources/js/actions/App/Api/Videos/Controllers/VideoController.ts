import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\VideoController::index
* @see src/App/Api/Videos/Controllers/VideoController.php:24
* @route '/api/v1/videos'
*/
export const index = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos',
}

/**
* @see \App\Api\Videos\Controllers\VideoController::index
* @see src/App/Api/Videos/Controllers/VideoController.php:24
* @route '/api/v1/videos'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoController::index
* @see src/App/Api/Videos/Controllers/VideoController.php:24
* @route '/api/v1/videos'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::index
* @see src/App/Api/Videos/Controllers/VideoController.php:24
* @route '/api/v1/videos'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::store
* @see src/App/Api/Videos/Controllers/VideoController.php:32
* @route '/api/v1/videos'
*/
export const store = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ['post'],
    url: '/api/v1/videos',
}

/**
* @see \App\Api\Videos\Controllers\VideoController::store
* @see src/App/Api/Videos/Controllers/VideoController.php:32
* @route '/api/v1/videos'
*/
store.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoController::store
* @see src/App/Api/Videos/Controllers/VideoController.php:32
* @route '/api/v1/videos'
*/
store.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::show
* @see src/App/Api/Videos/Controllers/VideoController.php:40
* @route '/api/v1/videos/{video}'
*/
export const show = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}',
}

/**
* @see \App\Api\Videos\Controllers\VideoController::show
* @see src/App/Api/Videos/Controllers/VideoController.php:40
* @route '/api/v1/videos/{video}'
*/
show.url = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: args.video,
    }

    return show.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoController::show
* @see src/App/Api/Videos/Controllers/VideoController.php:40
* @route '/api/v1/videos/{video}'
*/
show.get = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::show
* @see src/App/Api/Videos/Controllers/VideoController.php:40
* @route '/api/v1/videos/{video}'
*/
show.head = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::update
* @see src/App/Api/Videos/Controllers/VideoController.php:48
* @route '/api/v1/videos/{video}'
*/
export const update = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ['put','patch'],
    url: '/api/v1/videos/{video}',
}

/**
* @see \App\Api\Videos\Controllers\VideoController::update
* @see src/App/Api/Videos/Controllers/VideoController.php:48
* @route '/api/v1/videos/{video}'
*/
update.url = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: args.video,
    }

    return update.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoController::update
* @see src/App/Api/Videos/Controllers/VideoController.php:48
* @route '/api/v1/videos/{video}'
*/
update.put = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'put',
} => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::update
* @see src/App/Api/Videos/Controllers/VideoController.php:48
* @route '/api/v1/videos/{video}'
*/
update.patch = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'patch',
} => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Api\Videos\Controllers\VideoController::destroy
* @see src/App/Api/Videos/Controllers/VideoController.php:56
* @route '/api/v1/videos/{video}'
*/
export const destroy = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ['delete'],
    url: '/api/v1/videos/{video}',
}

/**
* @see \App\Api\Videos\Controllers\VideoController::destroy
* @see src/App/Api/Videos/Controllers/VideoController.php:56
* @route '/api/v1/videos/{video}'
*/
destroy.url = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: args.video,
    }

    return destroy.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\VideoController::destroy
* @see src/App/Api/Videos/Controllers/VideoController.php:56
* @route '/api/v1/videos/{video}'
*/
destroy.delete = (args: { video: string | number } | [video: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'delete',
} => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const VideoController = { index, store, show, update, destroy }

export default VideoController