import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Web\Account\Controllers\DiscoverController::__invoke
* @see src/App/Web/Account/Controllers/DiscoverController.php:28
* @route '/'
*/
const DiscoverController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DiscoverController.url(options),
    method: 'get',
})

DiscoverController.definition = {
    methods: ['get','head'],
    url: '/',
}

/**
* @see \App\Web\Account\Controllers\DiscoverController::__invoke
* @see src/App/Web/Account/Controllers/DiscoverController.php:28
* @route '/'
*/
DiscoverController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return DiscoverController.definition.url + queryParams(options)
}

/**
* @see \App\Web\Account\Controllers\DiscoverController::__invoke
* @see src/App/Web/Account/Controllers/DiscoverController.php:28
* @route '/'
*/
DiscoverController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DiscoverController.url(options),
    method: 'get',
})

/**
* @see \App\Web\Account\Controllers\DiscoverController::__invoke
* @see src/App/Web/Account/Controllers/DiscoverController.php:28
* @route '/'
*/
DiscoverController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: DiscoverController.url(options),
    method: 'head',
})

export default DiscoverController