<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth Login & Register
$routes->group('', ['filter' => 'guest', 'namespace' => Auth::class], function (RouteCollection $routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login', 'LoginController::login');
    $routes->get('register', 'RegisterController::index');
    $routes->post('register', 'RegisterController::register');
});

$routes->get('(:any)', 'ProfileController::index/$1');
