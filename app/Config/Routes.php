<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('students', 'StudentController::index', ['filter' => 'dbCheck']);
$routes->post('student/create', 'StudentController::create', ['filter' => 'dbCheck']);
$routes->put('student/update/(:segment)', 'StudentController::update/$1', ['filter' => 'dbCheck']);
$routes->delete('students/(:num)', 'StudentController::delete/$1', ['filter' => 'dbCheck']);
