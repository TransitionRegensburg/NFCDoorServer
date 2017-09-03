<?php

use Dingo\Api\Routing\Router;

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
        $payload = JWTAuth::parseToken()->getPayload();
        if (isset($payload['door'])) {
            $api->get('grants', 'App\\Api\\V1\\Controllers\\DoorController@grants');
        } else {
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

            $api->post('door/store', 'App\\Api\\V1\\Controllers\\DoorController@store');
            $api->get('door', 'App\\Api\\V1\\Controllers\\DoorController@index');
        }
    });

    $api->get('hello', function () {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
