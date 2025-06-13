import { queryParams, type QueryParams } from './../../../wayfinder'
/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/api/v1/broadcasting/auth'
*/
const authenticate65f260e428b357c0f6e2873c583bc91d = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: authenticate65f260e428b357c0f6e2873c583bc91d.url(options),
    method: 'get',
})

authenticate65f260e428b357c0f6e2873c583bc91d.definition = {
    methods: ['get','post','head'],
    url: '/api/v1/broadcasting/auth',
}

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/api/v1/broadcasting/auth'
*/
authenticate65f260e428b357c0f6e2873c583bc91d.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return authenticate65f260e428b357c0f6e2873c583bc91d.definition.url + queryParams(options)
}

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/api/v1/broadcasting/auth'
*/
authenticate65f260e428b357c0f6e2873c583bc91d.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: authenticate65f260e428b357c0f6e2873c583bc91d.url(options),
    method: 'get',
})

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/api/v1/broadcasting/auth'
*/
authenticate65f260e428b357c0f6e2873c583bc91d.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: authenticate65f260e428b357c0f6e2873c583bc91d.url(options),
    method: 'post',
})

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/api/v1/broadcasting/auth'
*/
authenticate65f260e428b357c0f6e2873c583bc91d.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: authenticate65f260e428b357c0f6e2873c583bc91d.url(options),
    method: 'head',
})

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/broadcasting/auth'
*/
const authenticate22644bf8ccadfabcc6535c87c6c6d31d = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: authenticate22644bf8ccadfabcc6535c87c6c6d31d.url(options),
    method: 'get',
})

authenticate22644bf8ccadfabcc6535c87c6c6d31d.definition = {
    methods: ['get','post','head'],
    url: '/broadcasting/auth',
}

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/broadcasting/auth'
*/
authenticate22644bf8ccadfabcc6535c87c6c6d31d.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return authenticate22644bf8ccadfabcc6535c87c6c6d31d.definition.url + queryParams(options)
}

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/broadcasting/auth'
*/
authenticate22644bf8ccadfabcc6535c87c6c6d31d.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: authenticate22644bf8ccadfabcc6535c87c6c6d31d.url(options),
    method: 'get',
})

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/broadcasting/auth'
*/
authenticate22644bf8ccadfabcc6535c87c6c6d31d.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: authenticate22644bf8ccadfabcc6535c87c6c6d31d.url(options),
    method: 'post',
})

/**
* @see \Illuminate\Broadcasting\BroadcastController::authenticate
* @see vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastController.php:18
* @route '/broadcasting/auth'
*/
authenticate22644bf8ccadfabcc6535c87c6c6d31d.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: authenticate22644bf8ccadfabcc6535c87c6c6d31d.url(options),
    method: 'head',
})

export const authenticate = {
    '/api/v1/broadcasting/auth': authenticate65f260e428b357c0f6e2873c583bc91d,
    '/broadcasting/auth': authenticate22644bf8ccadfabcc6535c87c6c6d31d,
}

const BroadcastController = { authenticate }

export default BroadcastController