<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace'  => 'App\Http\Controllers\Api',
    'middleware' => [
        'cors',
        'api.throttle',
    ],
    'limit'   => 60,
    'expires' => 1,
], function (\Dingo\Api\Routing\Router $api) {
    /**
     * 统一处理OPTIONS请求, 不需要再为每个路由配置options路由了
     */
    $api->options('/{all:[a-zA-Z0-9-\/_]+}', function () {
        // 空路由, 具体处理由跨域中间件cors完成
    });

    $api->get('/user/auth', 'User\Auth@index');
});
