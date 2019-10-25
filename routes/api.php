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

    /**
     * 无需认证的接口
     */
    $api->group(['prefix' => '/user'], function (\Dingo\Api\Routing\Router $api) {
        $api->post('login', 'User\AuthController@login');
        $api->post('register', 'User\AuthController@register');
    });

    $api->group(['prefix' => '/admin', 'middleware' => 'admin'], function (\Dingo\Api\Routing\Router $api) {
        $api->post('login', 'Admin\AuthController@login');
        $api->post('register', 'Admin\AuthController@register');
    });

    $api->group(['prefix' => '/ops', 'middleware' => 'ops'], function (\Dingo\Api\Routing\Router $api) {
        $api->post('login', 'Ops\AuthController@login');
        $api->post('register', 'Ops\AuthController@register');
    });

    /**
     * 需认证的接口
     */
    $api->group(['middleware' => 'api.auth'], function (\Dingo\Api\Routing\Router $api) {
        $api->get('/user/me', 'User\AuthController@me');
    });

    $api->group(['middleware' => ['admin', 'api.auth']], function (\Dingo\Api\Routing\Router $api) {
        $api->get('/admin/me', 'Admin\AuthController@me');
    });

    $api->group(['middleware' => ['ops', 'api.auth']], function (\Dingo\Api\Routing\Router $api) {
        $api->get('/ops/me', 'Ops\AuthController@me');
    });
});
