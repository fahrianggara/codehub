<?php

use App\Controllers\Auth;
use App\Controllers\Backend;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Auth Login, Register and Logout
$routes->group('', ['namespace' => Auth::class], function (RouteCollection $routes) {
    $routes->match(['get', 'post'], 'login', 'LoginController::index', ['as' => 'login', 'filter' => 'guest']);
    $routes->match(['get', 'post'], 'register', 'RegisterController::index', ['as' => 'register', 'filter' => 'guest']);
    $routes->delete('logout', 'LoginController::logout', ['as'=> 'logout', 'filter' => 'auth']);
});

// Auth Backend Dashboard
$routes->group('admin', ['filter' => ['auth', 'is_admin'], 'namespace' => Backend::class], function (RouteCollection $routes) {
    $routes->get('dash', 'DashController::index', ['as' => 'admin.dash']);
});

// Profile User
$routes->post('change-password', 'ProfileController::changePassword', ['as' => 'profile.change-password', 'filter' => 'auth']);
$routes->get('(:any)', 'ProfileController::index/$1', ['as' => 'profile']);

