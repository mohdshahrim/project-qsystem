<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/testgeneral', 'Home::testgeneral');
$routes->get('/testdb', 'Home::testdb');
$routes->get('/testforge', 'Home::testforge');
