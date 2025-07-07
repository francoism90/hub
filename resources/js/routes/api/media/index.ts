import { queryParams, type QueryParams, validateParameters } from './../../../wayfinder'
/**
* @see \App\Api\Media\Controllers\AssetController::asset
* @see src/App/Api/Media/Controllers/AssetController.php:26
* @route '/api/v1/asset/{media}/{conversion?}'
*/
export const asset = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: asset.url(args, options),
    method: 'get',
})

asset.definition = {
    methods: ['get','head'],
    url: '/api/v1/asset/{media}/{conversion?}',
}

/**
* @see \App\Api\Media\Controllers\AssetController::asset
* @see src/App/Api/Media/Controllers/AssetController.php:26
* @route '/api/v1/asset/{media}/{conversion?}'
*/
asset.url = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return asset.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\AssetController::asset
* @see src/App/Api/Media/Controllers/AssetController.php:26
* @route '/api/v1/asset/{media}/{conversion?}'
*/
asset.get = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: asset.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\AssetController::asset
* @see src/App/Api/Media/Controllers/AssetController.php:26
* @route '/api/v1/asset/{media}/{conversion?}'
*/
asset.head = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: asset.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Media\Controllers\DownloadController::download
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
export const download = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: download.url(args, options),
    method: 'get',
})

download.definition = {
    methods: ['get','head'],
    url: '/api/v1/download/{media}/{conversion?}',
}

/**
* @see \App\Api\Media\Controllers\DownloadController::download
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
download.url = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return download.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\DownloadController::download
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
download.get = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: download.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\DownloadController::download
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
download.head = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: download.url(args, options),
    method: 'head',
})

/**
* @see \App\Api\Media\Controllers\ResponsiveController::responsive
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
export const responsive = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: responsive.url(args, options),
    method: 'get',
})

responsive.definition = {
    methods: ['get','head'],
    url: '/api/v1/responsive/{media}/{conversion?}/{path?}',
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::responsive
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
responsive.url = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return responsive.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace('{path?}', parsedArgs.path?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\ResponsiveController::responsive
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
responsive.get = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: responsive.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\ResponsiveController::responsive
* @see src/App/Api/Media/Controllers/ResponsiveController.php:15
* @route '/api/v1/responsive/{media}/{conversion?}/{path?}'
*/
responsive.head = (args: { media: string | { uuid: string }, conversion?: string | number, path?: string | number } | [media: string | { uuid: string }, conversion: string | number, path: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: responsive.url(args, options),
    method: 'head',
})

const media = {
    asset,
    download,
    responsive,
}

export default media