import { queryParams, type QueryParams, validateParameters } from './../../../../../wayfinder'
/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}'
*/
const ResponsiveController = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'get',
})

ResponsiveController.definition = {
    methods: ['get','head'],
    url: '/api/v1/responsive/{media}/{conversion?}',
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}'
*/
ResponsiveController.url = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            media: args[0],
            conversion: args[1],
        }
    }

    validateParameters(args, [
        "conversion",
    ])

    const parsedArgs = {
        media: typeof args.media === 'object'
        ? args.media.uuid
        : args.media,
        conversion: args.conversion,
    }

    return ResponsiveController.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}'
*/
ResponsiveController.get = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}'
*/
ResponsiveController.head = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'head',
})

export default ResponsiveController