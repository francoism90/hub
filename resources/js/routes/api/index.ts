import { queryParams, type QueryParams } from './../../wayfinder'
import media from './media'
import videos from './videos'
/**
* @see \App\Api\Authentication\Controllers\HomeController::home
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
export const home = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: home.url(options),
    method: 'get',
})

home.definition = {
    methods: ['get','head'],
    url: '/api/v1',
}

/**
* @see \App\Api\Authentication\Controllers\HomeController::home
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
home.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return home.definition.url + queryParams(options)
}

/**
* @see \App\Api\Authentication\Controllers\HomeController::home
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
home.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: home.url(options),
    method: 'get',
})

/**
* @see \App\Api\Authentication\Controllers\HomeController::home
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
home.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: home.url(options),
    method: 'head',
})

const api = {
    home,
    media,
    videos,
}

export default api