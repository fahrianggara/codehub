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

    // Pengguna
    $routes->group('pengguna', function (RouteCollection $routes) {
        $routes->get('/', 'PenggunaController::index', ['as' => 'admin.pengguna']);
        $routes->get('create', 'PenggunaController::create', ['as' => 'admin.pengguna.create']);
        $routes->post('store', 'PenggunaController::store', ['as' => 'admin.pengguna.store']);
        $routes->post('destroy', 'PenggunaController::destroy', ['as' => 'admin.pengguna.destroy']);
        $routes->post('update', 'PenggunaController::update', ['as' => 'admin.pengguna.update']);
        $routes->get('(:segment)/edit', 'PenggunaController::edit/$1', ['as' => 'admin.pengguna.edit']);
    });
});

// Profile User
$routes->post('edit-avatar', 'ProfileController::editAvatar', ['as' => 'profile.edit-avatar', 'filter' => 'auth']);
$routes->delete('destroy-avatar', 'ProfileController::destroyAvatar', ['as' => 'profile.destroy-avatar', 'filter' => 'auth']);
$routes->post('edit-banner', 'ProfileController::editBanner', ['as' => 'profile.edit-banner', 'filter' => 'auth']);
$routes->delete('destroy-banner', 'ProfileController::destroyBanner', ['as' => 'profile.destroy-banner', 'filter' => 'auth']);
$routes->post('edit-password', 'ProfileController::editPassword', ['as' => 'profile.edit-password', 'filter' => 'auth']);
$routes->post('edit-profile', 'ProfileController::editProfile', ['as' => 'profile.edit-profile', 'filter' => 'auth']);
$routes->get('(:any)', 'ProfileController::index/$1', ['as' => 'profile']);

