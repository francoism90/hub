import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Authentication\Controllers\HomeController::__invoke
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
const HomeController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: HomeController.url(options),
    method: 'get',
})

HomeController.definition = {
    methods: ['get','head'],
    url: '/api/v1',
}

/**
* @see \App\Api\Authentication\Controllers\HomeController::__invoke
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
HomeController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return HomeController.definition.url + queryParams(options)
}

/**
* @see \App\Api\Authentication\Controllers\HomeController::__invoke
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
HomeController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: HomeController.url(options),
    method: 'get',
})

/**
* @see \App\Api\Authentication\Controllers\HomeController::__invoke
* @see src/App/Api/Authentication/Controllers/HomeController.php:21
* @route '/api/v1'
*/
HomeController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: HomeController.url(options),
    method: 'head',
})

export default HomeController