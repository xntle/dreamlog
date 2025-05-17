<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//frontend
$routes->get('/', 'DreamController::homepage');
$routes->get('/create', 'DreamController::createpage');
$routes->get('/calendar', 'DreamController::calendarpage');
$routes->get('calendar/(:num)/(:num)', 'DreamController::index/$1/$2');

// API 
$routes->group('api', function($routes) {
    $routes->post('create', 'DreamController::create');
    $routes->get('dreams', 'DreamController::getDream');
    $routes->get('dreams/(:num)', 'DreamController::view/$1');
});

// Dream page
$routes->get('dream/(:num)', 'DreamController::view/$1');

