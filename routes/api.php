<?php

use Dingo\Api\Routing\Router;
use JWTAuth;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => 'jwt.auth'], function (Router $api) {
        $api->get('protected', function () {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function () {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);

        $api->resource('doors', 'App\\Api\\V1\\Controllers\\DoorController');
        $api->resource('door-users', 'App\\Api\\V1\\Controllers\\DoorUserController');
        $api->resource('door-user-grants', 'App\\Api\\V1\\Controllers\\DoorUserGrantController');
        $api->resource('logs', 'App\\Api\\V1\\Controllers\\LogController');
        $api->resource('managers', 'App\\Api\\V1\\Controllers\\ManagerController');

        /*
        $api->post('doors/createDoor', 'App\\Api\\V1\\Controllers\\DoorController@storeDoor');
        $api->post('doors/createManager', 'App\\Api\\V1\\Controllers\\DoorController@storeManager');
        $api->post('doors/createUser', 'App\\Api\\V1\\Controllers\\DoorController@storeUser');
        $api->post('doors/createGrant', 'App\\Api\\V1\\Controllers\\DoorController@storeGrant');

        $api->get('doors', 'App\\Api\\V1\\Controllers\\DoorController@index');
        $api->get('door/manager', 'App\\Api\\V1\\Controllers\\DoorController@manager');
        $api->get('door/user', 'App\\Api\\V1\\Controllers\\DoorController@manager');
        $api->get('door/grants/{door}', 'App\\Api\\V1\\Controllers\\DoorController@grants');
        */

    });

    $api->get('hello', function () {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
