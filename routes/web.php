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
    return "Welcome to Tel-Schedule API";
});


// $router->group([
//     'prefix' => 'auth',
//     // 'middleware' => 'api'
// ], function () use ($router){

//     //Authentication
//     // $router->post('register', 'Auth\RegisterController@store');
//     // $router->post('login', 'Auth\LoginController@login');
//     $router->post('register', 'Auth\AuthController@register');
//     $router->post('login', 'Auth\AuthController@login');

// });

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'v1'
  
  ], function ($router) {
    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
  });

$router->post('takeAll', 'Auth\RegisterController@takeAll');

