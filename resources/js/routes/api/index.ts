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

/**
* @see \App\Api\Users\Controllers\SubscriptionController::subscription
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
export const subscription = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: subscription.url(options),
    method: 'get',
})

subscription.definition = {
    methods: ['get','head'],
    url: '/api/v1/subscription',
}

/**
* @see \App\Api\Users\Controllers\SubscriptionController::subscription
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
subscription.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return subscription.definition.url + queryParams(options)
}

/**
* @see \App\Api\Users\Controllers\SubscriptionController::subscription
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
subscription.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: subscription.url(options),
    method: 'get',
})

/**
* @see \App\Api\Users\Controllers\SubscriptionController::subscription
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
subscription.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: subscription.url(options),
    method: 'head',
})

const api = {
    home,
    subscription,
    media,
    videos,
}

export default api