import { queryParams, type QueryParams, validateParameters } from './../../../../../wayfinder'
/**
* @see \App\Api\Media\Controllers\AssetController::__invoke
* @see src/App/Api/Media/Controllers/AssetController.php:24
* @route '/api/v1/asset/{media}/{conversion?}'
*/
const AssetController = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: AssetController.url(args, options),
    method: 'get',
})

AssetController.definition = {
    methods: ['get','head'],
    url: '/api/v1/asset/{media}/{conversion?}',
}

/**
* @see \App\Api\Media\Controllers\AssetController::__invoke
* @see src/App/Api/Media/Controllers/AssetController.php:24
* @route '/api/v1/asset/{media}/{conversion?}'
*/
AssetController.url = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return AssetController.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\AssetController::__invoke
* @see src/App/Api/Media/Controllers/AssetController.php:24
* @route '/api/v1/asset/{media}/{conversion?}'
*/
AssetController.get = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: AssetController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\AssetController::__invoke
* @see src/App/Api/Media/Controllers/AssetController.php:24
* @route '/api/v1/asset/{media}/{conversion?}'
*/
AssetController.head = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: AssetController.url(args, options),
    method: 'head',
})

export default AssetController