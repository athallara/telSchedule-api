<?php

$router->group([
    'prefix' => 'auth',
], function () use ($router){

    //Authentication
    $router->post('register', 'Auth\AuthController@register');
    $router->post('login', 'Auth\AuthController@login');
    $router->post('logout', 'Auth\AuthController@logout');
    // $router->post('logout', 'Auth\AuthController@logout'); //Logout Should be Implement using Redis
});

$router->group([
    'prefix' => 'user',
], function () use ($router){
    $router->get('getAllUser','User\UserController@getAllUser');
});

$router->group([
    'prefix' => 'course',
], function () use ($router){
    $router->post('createUserCourse', 'Course\CourseController@createUserCourse');
    $router->get('getUserCourse', 'Course\CourseController@getUserCourse');
});

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});
