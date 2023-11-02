<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Auth Login & Register
$routes->group('', ['filter' => 'guest', 'namespace' => Auth::class], function (RouteCollection $routes) {
    $routes->match(['get', 'post'], 'login', 'LoginController::index');
    $routes->match(['get', 'post'], 'register', 'RegisterController::index');
});

$routes->group('', ['filter' => 'auth', 'namespace' => Auth::class], function (RouteCollection $routes) {
    $routes->delete('logout', 'LoginController::logout');
});

$routes->get('(:segment)', 'ProfileController::index/$1');
