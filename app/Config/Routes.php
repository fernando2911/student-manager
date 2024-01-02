<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', function($routes) {
    $routes->post('login', 'AuthController::login', ['filter' => 'dbCheck']);
    
    //Students
    $routes->get('students', 'StudentController::index', ['filter' => 'dbCheckAndJwt']);
    
    $routes->group('student', ['filter' => 'dbCheckAndJwt'], function($routes) {
        $routes->post('create', 'StudentController::create');
        $routes->post('update/(:segment)', 'StudentController::update/$1');
    });

    $routes->delete('students/(:num)', 'StudentController::delete/$1', ['filter' => 'dbCheckAndJwt']);
    //-----
});
