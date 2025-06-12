import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\MailEmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailEmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/download'
*/
export const show = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/telescope/telescope-api/mail/{telescopeEntryId}/download',
}

/**
* @see \Laravel\Telescope\Http\Controllers\MailEmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailEmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/download'
*/
show.url = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { telescopeEntryId: args }
    }

    if (Array.isArray(args)) {
        args = {
            telescopeEntryId: args[0],
        }
    }

    const parsedArgs = {
        telescopeEntryId: args.telescopeEntryId,
    }

    return show.definition.url
            .replace('{telescopeEntryId}', parsedArgs.telescopeEntryId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Laravel\Telescope\Http\Controllers\MailEmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailEmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/download'
*/
show.get = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Laravel\Telescope\Http\Controllers\MailEmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailEmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/download'
*/
show.head = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

const MailEmlController = { show }

export default MailEmlController