import { queryParams, type QueryParams } from './../../wayfinder'
/**
* @see \App\Web\Videos\Controllers\VideoController::index
* @see src/App/Web/Videos/Controllers/VideoController.php:28
* @route '/videos'
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
    url: '/videos',
}

/**
* @see \App\Web\Videos\Controllers\VideoController::index
* @see src/App/Web/Videos/Controllers/VideoController.php:28
* @route '/videos'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoController::index
* @see src/App/Web/Videos/Controllers/VideoController.php:28
* @route '/videos'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::index
* @see src/App/Web/Videos/Controllers/VideoController.php:28
* @route '/videos'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::create
* @see src/App/Web/Videos/Controllers/VideoController.php:33
* @route '/videos/create'
*/
export const create = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ['get','head'],
    url: '/videos/create',
}

/**
* @see \App\Web\Videos\Controllers\VideoController::create
* @see src/App/Web/Videos/Controllers/VideoController.php:33
* @route '/videos/create'
*/
create.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoController::create
* @see src/App/Web/Videos/Controllers/VideoController.php:33
* @route '/videos/create'
*/
create.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::create
* @see src/App/Web/Videos/Controllers/VideoController.php:33
* @route '/videos/create'
*/
create.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::show
* @see src/App/Web/Videos/Controllers/VideoController.php:42
* @route '/videos/{video}'
*/
export const show = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/videos/{video}',
}

/**
* @see \App\Web\Videos\Controllers\VideoController::show
* @see src/App/Web/Videos/Controllers/VideoController.php:42
* @route '/videos/{video}'
*/
show.url = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'ulid' in args) {
        args = { video: args.ulid }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.ulid
        : args.video,
    }

    return show.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoController::show
* @see src/App/Web/Videos/Controllers/VideoController.php:42
* @route '/videos/{video}'
*/
show.get = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::show
* @see src/App/Web/Videos/Controllers/VideoController.php:42
* @route '/videos/{video}'
*/
show.head = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::edit
* @see src/App/Web/Videos/Controllers/VideoController.php:56
* @route '/videos/{video}/edit'
*/
export const edit = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ['get','head'],
    url: '/videos/{video}/edit',
}

/**
* @see \App\Web\Videos\Controllers\VideoController::edit
* @see src/App/Web/Videos/Controllers/VideoController.php:56
* @route '/videos/{video}/edit'
*/
edit.url = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { video: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'ulid' in args) {
        args = { video: args.ulid }
    }

    if (Array.isArray(args)) {
        args = {
            video: args[0],
        }
    }

    const parsedArgs = {
        video: typeof args.video === 'object'
        ? args.video.ulid
        : args.video,
    }

    return edit.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoController::edit
* @see src/App/Web/Videos/Controllers/VideoController.php:56
* @route '/videos/{video}/edit'
*/
edit.get = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoController::edit
* @see src/App/Web/Videos/Controllers/VideoController.php:56
* @route '/videos/{video}/edit'
*/
edit.head = (args: { video: string | { ulid: string } } | [video: string | { ulid: string } ] | string | { ulid: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: edit.url(args, options),
    method: 'head',
})

const videos = {
    index,
    create,
    show,
    edit,
}

export default videos