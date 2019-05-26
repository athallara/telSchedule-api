<?php

/** 
 * @category Auth Modules
 */

$router->group([
    'prefix' => 'auth',
], function () use ($router){
    $router->post('register', 'Auth\AuthController@register');
    $router->post('login', 'Auth\AuthController@login');
    $router->post('logout', 'Auth\AuthController@logout');
});

/**
 * @category Course Modules
 */

$router->group([
    'prefix' => 'course',
], function () use ($router){
    $router->post('createUserCourse', 'Course\CourseController@createUserCourse');
    $router->get('getUserCourse', 'Course\CourseController@getUserCourse');
});

/**
 * @category User Modules
 */

$router->group([
    'prefix' => 'user',
], function () use ($router){
    $router->get('getAllUser','User\UserController@getAllUser');
});

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});
