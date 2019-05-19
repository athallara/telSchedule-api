<?php

$router->group([
    'prefix' => 'auth',
], function () use ($router){

    //Authentication
    $router->post('register', 'Auth\AuthController@register');
    $router->post('login', 'Auth\AuthController@login');
    // $router->post('logout', 'Auth\AuthController@logout'); //Logout Should be Implement using Redis
    
});

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});
