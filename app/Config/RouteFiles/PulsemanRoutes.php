<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/pulseman', 'Pulseman::index');

/* IP */
$routes->get('/pulseman/ip', 'Pulseman::pageIP');
$routes->get('/pulseman/ip/new', 'Pulseman::pageIPNew');
$routes->post('/pulseman/ip/create', 'Pulseman::postIPCreate');
$routes->get('/pulseman/ip/(:num)', 'Pulseman::pageIPRead/$1');
$routes->post('/pulseman/ip/update', 'Pulseman::postIPUpdate');
$routes->get('/pulseman/ip/delete/(:num)', 'Pulseman::getIPDelete/$1');

/* STATUS CODE */
$routes->get('/pulseman/statuscode', 'Pulseman::pageStatusCode');
$routes->get('/pulseman/statuscode/new', 'Pulseman::pageStatusCodeNew');
$routes->post('/pulseman/statuscode/create', 'Pulseman::postStatusCodeCreate');