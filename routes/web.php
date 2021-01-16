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

$router->get('/key', function () use ($router) {
    return \Illuminate\Support\Str::random(32);
});

$router->group([ // http://localhost:8080/api
    'prefix' => 'api',
], function () use ($router) {
//    $router->group([ // http://localhost:8080/api/users
//        'prefix' => 'users',
//    ], function () use ($router) {
//        $router->group([
//            'prefix' => 'form',
//        ], function () use ($router) {
//            $router->post('filter', 'UserController@filter'); // {}
//            $router->post('data', 'UserController@data'); // {id: ?}
//        });
//        $router->group([
//            'prefix' => 'raw',
//        ], function () use ($router) {
//            $router->post('', 'UserController@raw'); // {}
//        });
//        $router->post('save', 'UserController@save'); // {}
//        $router->post('update', 'UserController@update'); // {}
//        $router->delete('delete', 'UserController@delete'); // {id: ?}
//    });
    $router->group([ // http://localhost:8080/api/users
        'prefix' => 'users',
    ], function () use ($router) {
        $router->get('', 'UserController@index');
        $router->get('create', 'UserController@create');
        $router->post('', 'UserController@store');
        $router->get('{id}', 'UserController@show');
        $router->get('{id}/edit', 'UserController@edit');
        $router->put('{id}', 'UserController@update');
        $router->delete('{id}', 'UserController@destroy');
    });


    $router->post('login', 'AuthController@login');
});


