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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');

    // Matches "/api/login
    $router->post('login', 'AuthController@login');
    
    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/api/users/1 
    //get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/api/users
    $router->get('users', 'UserController@allUsers');

    $router->get('mqtt', 'MqttController@index');
    $router->get('mqtt/{id}', 'MqttController@show');
    $router->get('mqtt/topic/{topic}', 'MqttController@getDataTopic');
    $router->post('mqtt', 'MqttController@store');
    $router->put('mqtt/{id}', 'MqttController@update');
    $router->delete('mqtt/{id}', 'MqttController@destroy');
});
$router->get('mqtt/topic/{topic}', 'MqttController@getDataTopic');