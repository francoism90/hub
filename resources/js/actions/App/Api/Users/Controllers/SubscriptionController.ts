import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Api\Users\Controllers\SubscriptionController::__invoke
* @see src/App/Api/Users/Controllers/SubscriptionController.php:26
* @route '/api/v1/subscription'
*/
const SubscriptionController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: SubscriptionController.url(options),
    method: 'post',
})

SubscriptionController.definition = {
    methods: ['post'],
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
SubscriptionController.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: SubscriptionController.url(options),
    method: 'post',
})

export default SubscriptionController