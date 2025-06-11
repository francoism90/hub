import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/'
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
    url: '/',
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/'
*/
VideoIndexController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return VideoIndexController.definition.url + queryParams(options)
}

/**
* @see \App\Web\Videos\Controllers\VideoIndexController::__invoke
* @see src/App/Web/Videos/Controllers/VideoIndexController.php:28
* @route '/'
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
* @route '/'
*/
VideoIndexController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: VideoIndexController.url(options),
    method: 'head',
})

export default VideoIndexController