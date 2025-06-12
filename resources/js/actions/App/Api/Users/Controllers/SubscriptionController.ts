import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Users\Controllers\SubscriptionController::__invoke
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
const SubscriptionController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: SubscriptionController.url(options),
    method: 'get',
})

SubscriptionController.definition = {
    methods: ['get','head'],
    url: '/api/v1/subscription',
}

/**
* @see \App\Api\Users\Controllers\SubscriptionController::__invoke
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
SubscriptionController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return SubscriptionController.definition.url + queryParams(options)
}

/**
* @see \App\Api\Users\Controllers\SubscriptionController::__invoke
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
SubscriptionController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: SubscriptionController.url(options),
    method: 'get',
})

/**
* @see \App\Api\Users\Controllers\SubscriptionController::__invoke
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
SubscriptionController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: SubscriptionController.url(options),
    method: 'head',
})

export default SubscriptionController