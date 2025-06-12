import { queryParams, type QueryParams } from './../../../wayfinder'
/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}/{format}'
*/
export const manifest = (args: { video: string | number, type: string | number, format: string | number } | [video: string | number, type: string | number, format: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: manifest.url(args, options),
    method: 'get',
})

manifest.definition = {
    methods: ['get','head'],
    url: '/api/v1/videos/{video}/manifest/{type}/{format}',
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}/{format}'
*/
manifest.url = (args: { video: string | number, type: string | number, format: string | number } | [video: string | number, type: string | number, format: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (Array.isArray(args)) {
        args = {
            video: args[0],
            type: args[1],
            format: args[2],
        }
    }

    const parsedArgs = {
        video: args.video,
        type: args.type,
        format: args.format,
    }

    return manifest.definition.url
            .replace('{video}', parsedArgs.video.toString())
            .replace('{type}', parsedArgs.type.toString())
            .replace('{format}', parsedArgs.format.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}/{format}'
*/
manifest.get = (args: { video: string | number, type: string | number, format: string | number } | [video: string | number, type: string | number, format: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: manifest.url(args, options),
    method: 'get',
})

/**
* @see \App\Api\Videos\Controllers\ManifestController::manifest
* @see src/App/Api/Videos/Controllers/ManifestController.php:27
* @route '/api/v1/videos/{video}/manifest/{type}/{format}'
*/
manifest.head = (args: { video: string | number, type: string | number, format: string | number } | [video: string | number, type: string | number, format: string | number ], options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: manifest.url(args, options),
    method: 'head',
})

const videos = {
    manifest,
}

export default videos