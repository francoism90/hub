import { queryParams, type QueryParams } from './../../wayfinder'
/**
* @see \App\Web\Videos\Controllers\VideoViewController::show
* @see src/App/Web/Videos/Controllers/VideoViewController.php:24
* @route '/videos/{video}'
*/
export const show = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
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
* @see \App\Web\Videos\Controllers\VideoViewController::show
* @see src/App/Web/Videos/Controllers/VideoViewController.php:24
* @route '/videos/{video}'
*/
show.url = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return show.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoViewController::show
* @see src/App/Web/Videos/Controllers/VideoViewController.php:24
* @route '/videos/{video}'
*/
show.get = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoViewController::show
* @see src/App/Web/Videos/Controllers/VideoViewController.php:24
* @route '/videos/{video}'
*/
show.head = (args: { video: string | { prefixed_id: string } } | [video: string | { prefixed_id: string } ] | string | { prefixed_id: string }, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

const videos = {
    show,
}

export default videos