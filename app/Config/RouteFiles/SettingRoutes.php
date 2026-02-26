<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/setting', 'Setting::index');
$routes->get('/setting/writable', 'Setting::pageWritable');
$routes->post('/setting/writable/clear-logs', 'Setting::postWritableClearLogs');
$routes->post('/setting/writable/clear-sessions', 'Setting::postWritableClearSessions');
$routes->post('/setting/writable/clear-debugbar', 'Setting::postWritableClearDebug');
