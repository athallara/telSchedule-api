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

$router->group(['prefix' => 'v1'], function () use ($router){

    //Authentication
    $router->post('register', 'Auth\RegisterController@store');

});

$router->get('takeAll', 'Auth\RegisterController@takeAll');

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});
