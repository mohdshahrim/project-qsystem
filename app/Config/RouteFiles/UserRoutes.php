<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->post('/login', 'User::postLogin');
$routes->get('/home', 'User::pageHome');
$routes->get('/logout', 'User::getLogout');
$routes->get('/my-account', 'User::pageMyAccount');
$routes->get('/my-account/change-password', 'User::pageChangePassword');
$routes->post('/my-account/change-password/update', 'User::postPasswordUpdate');
$routes->get('/my-account/update-account', 'User::pageUpdateAccount');
$routes->post('/my-account/update-account/update', 'User::postAccountUpdate');