import { queryParams, type QueryParams } from './../../wayfinder'
/**
* @see \App\Web\Videos\Controllers\VideoIndexController::index
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
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
    url: '/videos/videos',
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::index
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::index
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::index
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

const videos = {
    index,
}

export default videos