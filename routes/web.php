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
    $router->get('getUserCourse', 'Course\CourseController@getUserCourse');
    $router->post('createUserCourse', 'Course\CourseController@createUserCourse');
    $router->put('updateUserCourse/{id}', 'Course\CourseController@updateUserCourse');
    $router->delete('deleteUserCourse/{id}', 'Course\CourseController@deleteUserCourse');
});

/**
 * @category User Modules
 */

$router->group([
    'prefix' => 'user',
], function () use ($router){
    $router->get('getUserData','User\UserController@getUserData');
});

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});
