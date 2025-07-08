import { queryParams, type QueryParams, validateParameters } from './../../../../../wayfinder'
/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:26
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
const ResponsiveController = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'get',
})

ResponsiveController.definition = {
    methods: ['get','head'],
    url: '/api/v1/responsive/{media}/{conversion?}/{path?}',
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:26
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
ResponsiveController.url = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            media: args[0],
            conversion: args[1],
            path: args[2],
        }
    }

    validateParameters(args, [
        "conversion",
        "path",
    ])

    const parsedArgs = {
        media: typeof args.media === 'object'
        ? args.media.uuid
        : args.media,
        conversion: args.conversion,
        path: args.path,
    }

    return ResponsiveController.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace('{path?}', parsedArgs.path?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:26
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
ResponsiveController.get = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\ResponsiveController::__invoke
* @see src/App/Api/Media/Controllers/ResponsiveController.php:26
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
ResponsiveController.head = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ResponsiveController.url(args, options),
    method: 'head',
})

export default ResponsiveController