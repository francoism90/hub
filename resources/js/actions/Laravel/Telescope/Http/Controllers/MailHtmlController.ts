import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \Laravel\Telescope\Http\Controllers\MailHtmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailHtmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/preview'
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
    url: '/telescope/telescope-api/mail/{telescopeEntryId}/preview',
}

/**
* @see \Laravel\Telescope\Http\Controllers\MailHtmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailHtmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/preview'
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
* @see \Laravel\Telescope\Http\Controllers\MailHtmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailHtmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/preview'
*/
show.get = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Laravel\Telescope\Http\Controllers\MailHtmlController::show
* @see vendor/laravel/telescope/src/Http/Controllers/MailHtmlController.php:17
* @route '/telescope/telescope-api/mail/{telescopeEntryId}/preview'
*/
show.head = (args: { telescopeEntryId: string | number } | [telescopeEntryId: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

const MailHtmlController = { show }

export default MailHtmlController