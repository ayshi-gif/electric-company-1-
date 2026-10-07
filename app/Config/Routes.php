<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/services', 'Services::index');
$routes->match(['get', 'post'], '/contact', 'Contact::index');
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');
// Staff login
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout');

// Protected CRUD dashboard
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('account/new', 'Dashboard::create');
    $routes->post('account', 'Dashboard::store');
    $routes->get('account/(:num)', 'Dashboard::viewAccount/$1');
    $routes->get('account/(:num)/edit', 'Dashboard::edit/$1');
    $routes->post('account/(:num)/update', 'Dashboard::update/$1');
    $routes->get('account/(:num)/delete', 'Dashboard::confirmDelete/$1');
    $routes->post('account/(:num)/delete', 'Dashboard::delete/$1');
});


