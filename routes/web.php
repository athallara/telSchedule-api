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
    $router->get('getDetailCourse/{courseId}', 'Course\CourseController@getDetailCourse');
    $router->post('createCourse', 'Course\CourseController@createCourse');
    $router->put('updateCourse/{courseId}', 'Course\CourseController@updateCourse');
    $router->delete('deleteCourse/{courseId}', 'Course\CourseController@deleteCourse');
});

/**
 * @category Schedule Modules
 */

$router->group([
    'prefix' => 'schedule',
], function () use ($router){
    $router->get('getDetailSchedule/{scheduleId}','Schedule\ScheduleController@getDetailSchedule');
    $router->post('{courseId}/createSchedule', 'Schedule\ScheduleController@createSchedule');
    $router->put('updateSchedule/{scheduleId}','Schedule\ScheduleController@updateSchedule');
    $router->delete('deleteSchedule/{scheduleId}', 'Schedule\ScheduleController@deleteSchedule');
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
