import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
const VideoIndexController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoIndexController.url(options),
    method: 'get',
})

VideoIndexController.definition = {
    methods: ['get','head'],
    url: '/videos/videos',
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
VideoIndexController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return VideoIndexController.definition.url + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
VideoIndexController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: VideoIndexController.url(options),
    method: 'get',
})

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/videos/videos'
*/
VideoIndexController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: VideoIndexController.url(options),
    method: 'head',
})

export default VideoIndexController