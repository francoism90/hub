import { queryParams, type QueryParams, validateParameters } from './../../../../../wayfinder'
/**
* @see \App\Api\Media\Controllers\DownloadController::__invoke
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
const DownloadController = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DownloadController.url(args, options),
    method: 'get',
})

DownloadController.definition = {
    methods: ['get','head'],
    url: '/api/v1/download/{media}/{conversion?}',
}

/**
* @see \App\Api\Media\Controllers\DownloadController::__invoke
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
DownloadController.url = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
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

    return DownloadController.definition.url
            .replace('{media}', parsedArgs.media.toString())
            .replace('{conversion?}', parsedArgs.conversion?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Media\Controllers\DownloadController::__invoke
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
DownloadController.get = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DownloadController.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Media\Controllers\DownloadController::__invoke
* @see src/App/Api/Media/Controllers/DownloadController.php:26
* @route '/api/v1/download/{media}/{conversion?}'
*/
DownloadController.head = (args: { media: string | { uuid: string }, conversion?: string | number } | [media: string | { uuid: string }, conversion: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: DownloadController.url(args, options),
    method: 'head',
})

export default DownloadController