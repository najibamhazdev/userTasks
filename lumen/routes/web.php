<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// category routes
$router->get('/categories','CategoryController@index');
$router->post('/categories/create','CategoryController@store');
$router->get('/categories/{id}','CategoryController@show');
$router->put('/categories/update/{id}','CategoryController@update');
$router->delete('/categories/delete/{id}','CategoryController@destroy');

// Tasks route
$router->get('/tasks','TaskController@index');
$router->post('/tasks/create','TaskController@store');
$router->get('/tasks/{id}','TaskController@show');
$router->put('/tasks/update/{id}','TaskController@update');
$router->delete('/tasks/delete/{id}','TaskController@destroy');


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    
    $router->put('/users/update/{id}', 'AuthController@update');
});




