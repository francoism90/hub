import { queryParams, type QueryParams } from './../../../../../wayfinder'
/**
* @see \App\Web\Dashboard\Controllers\DashboardIndex::__invoke
* @see src/App/Web/Dashboard/Controllers/DashboardIndex.php:22
* @route '/'
*/
const DashboardIndex = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DashboardIndex.url(options),
    method: 'get',
})

DashboardIndex.definition = {
    methods: ['get','head'],
    url: '/',
}

/**
* @see \App\Web\Dashboard\Controllers\DashboardIndex::__invoke
* @see src/App/Web/Dashboard/Controllers/DashboardIndex.php:22
* @route '/'
*/
DashboardIndex.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return DashboardIndex.definition.url + queryParams(options)
}

/**
* @see \App\Web\Dashboard\Controllers\DashboardIndex::__invoke
* @see src/App/Web/Dashboard/Controllers/DashboardIndex.php:22
* @route '/'
*/
DashboardIndex.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: DashboardIndex.url(options),
    method: 'get',
})

/**
* @see \App\Web\Dashboard\Controllers\DashboardIndex::__invoke
* @see src/App/Web/Dashboard/Controllers/DashboardIndex.php:22
* @route '/'
*/
DashboardIndex.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: DashboardIndex.url(options),
    method: 'head',
})

export default DashboardIndex