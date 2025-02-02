<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// User operations
$routes->post('/user/login', 'User::postLogin');
$routes->get('/user/logout', 'User::postLogout');
$routes->get('/user/home', 'User::pageHome');
$routes->get('/user/account', 'User::pageUserAccount');
$routes->post('/user/password/update', 'User::postPasswordUpdate'); //STANDARD

// Claimmaker app
$routes->get('/claimmaker', 'Claimmaker::index');
$routes->post('/claimmaker/c', 'Claimmaker::postCreate');
$routes->get('/claimmaker/r/{:num}', 'Claimmaker::pageRead/$1');
$routes->get('/claimmaker/history', 'Claimmaker::pageHistory');


// Qrat
$routes->get('/qrat', 'Qrat::index');

// TEST
$routes->get('/testgeneral', 'Home::testgeneral');
$routes->get('/testdb', 'Home::testdb');
$routes->get('/testforge', 'Home::testforge');
$routes->get('/testmodel', 'Home::testmodel');
$routes->get('/testhash', 'Home::testhash');
