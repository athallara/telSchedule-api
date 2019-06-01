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
    $router->get('getCourse', 'Course\CourseController@getCourse');
    $router->get('getCourseAndSchedule', 'Course\CourseController@getCourseAndSchedule');
    $router->post('createCourse', 'Course\CourseController@createCourse');
    $router->put('updateUserCourse/{id}', 'Course\CourseController@updateUserCourse');
    $router->delete('deleteUserCourse/{id}', 'Course\CourseController@deleteUserCourse');
});

/**
 * @category User Modules
 */

$router->group([
    'prefix' => 'user',
], function () use ($router){
    $router->get('getUserProfile','User\UserController@getUserProfile');
    $router->put('updateUserProfile', 'User\UserController@updateUserProfile');
});

$router->get('/', function () use ($router) {
    return "Welcome to Tel-Schedule API";
});

$router->get('/test', 'Schedule\ScheduleController@getCourseFromSchedule');

$router->get('/daynow', 'Schedule\ScheduleController@daynow');
