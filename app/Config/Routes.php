<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login', ['filter' => 'dbCheck']);

$routes->group('api', ['filter' => 'dbCheckAndJwt'], function($routes) {

    //Students
    $routes->get('students', 'StudentController::index');

    $routes->group('student', function($routes) {
        $routes->post('create', 'StudentController::create');
        $routes->put('update/(:segment)', 'StudentController::update/$1');
    });

    $routes->delete('students/(:num)', 'StudentController::delete/$1');
    //-----
});
