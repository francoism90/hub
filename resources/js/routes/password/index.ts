import { queryParams, type QueryParams } from './../../wayfinder'
import confirm from './confirm'
/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::request
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:24
* @route '/forgot-password'
*/
export const request = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: request.url(options),
    method: 'get',
})

request.definition = {
    methods: ['get','head'],
    url: '/forgot-password',
}

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::request
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:24
* @route '/forgot-password'
*/
request.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return request.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::request
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:24
* @route '/forgot-password'
*/
request.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: request.url(options),
    method: 'get',
})

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::request
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:24
* @route '/forgot-password'
*/
request.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: request.url(options),
    method: 'head',
})

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::reset
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:44
* @route '/reset-password/{token}'
*/
export const reset = (args: { token: string | number } | [token: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: reset.url(args, options),
    method: 'get',
})

reset.definition = {
    methods: ['get','head'],
    url: '/reset-password/{token}',
}

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::reset
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:44
* @route '/reset-password/{token}'
*/
reset.url = (args: { token: string | number } | [token: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { token: args }
    }

    if (Array.isArray(args)) {
        args = {
            token: args[0],
        }
    }

    const parsedArgs = {
        token: args.token,
    }

    return reset.definition.url
            .replace('{token}', parsedArgs.token.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::reset
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:44
* @route '/reset-password/{token}'
*/
reset.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: reset.url(args, options),
    method: 'get',
})

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::reset
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:44
* @route '/reset-password/{token}'
*/
reset.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: reset.url(args, options),
    method: 'head',
})

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::email
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:35
* @route '/forgot-password'
*/
export const email = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: email.url(options),
    method: 'post',
})

email.definition = {
    methods: ['post'],
    url: '/forgot-password',
}

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::email
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:35
* @route '/forgot-password'
*/
email.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return email.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::email
* @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:35
* @route '/forgot-password'
*/
email.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: email.url(options),
    method: 'post',
})

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::update
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:55
* @route '/reset-password'
*/
export const update = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: update.url(options),
    method: 'post',
})

update.definition = {
    methods: ['post'],
    url: '/reset-password',
}

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::update
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:55
* @route '/reset-password'
*/
update.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return update.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\NewPasswordController::update
* @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:55
* @route '/reset-password'
*/
update.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: update.url(options),
    method: 'post',
})

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::confirm
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmablePasswordController.php:40
* @route '/user/confirm-password'
*/
export const confirm = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: confirm.url(options),
    method: 'get',
})

confirm.definition = {
    methods: ['get','head'],
    url: '/user/confirm-password',
}

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::confirm
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmablePasswordController.php:40
* @route '/user/confirm-password'
*/
confirm.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return confirm.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::confirm
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmablePasswordController.php:40
* @route '/user/confirm-password'
*/
confirm.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: confirm.url(options),
    method: 'get',
})

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmablePasswordController::confirm
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmablePasswordController.php:40
* @route '/user/confirm-password'
*/
confirm.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: confirm.url(options),
    method: 'head',
})

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
* @route '/user/confirmed-password-status'
*/
export const confirmation = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: confirmation.url(options),
    method: 'get',
})

confirmation.definition = {
    methods: ['get','head'],
    url: '/user/confirmed-password-status',
}

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
* @route '/user/confirmed-password-status'
*/
confirmation.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return confirmation.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
* @route '/user/confirmed-password-status'
*/
confirmation.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: confirmation.url(options),
    method: 'get',
})

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
* @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
* @route '/user/confirmed-password-status'
*/
confirmation.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: confirmation.url(options),
    method: 'head',
})

const password = {
    request,
    reset,
    email,
    update,
    confirm,
    confirmation,
}

export default password