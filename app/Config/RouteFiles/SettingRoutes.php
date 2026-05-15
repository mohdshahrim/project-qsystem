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

$routes->get('/setting/database', 'Setting::pageDatabase');
$routes->post('/setting/database/backup', 'Setting::postDatabaseBackup');
$routes->post('/setting/database/restore', 'Setting::postDatabaseRestore');
$routes->post('/setting/database/delete-backup', 'Setting::postDatabaseDeleteBackup');
$routes->get('/setting/database/export', 'Setting::getDatabaseExport');
$routes->get('/setting/database/reset-wizard', 'Setting::pageDatabaseResetWizard');
$routes->post('/setting/database/reset-wizard/submit', 'Setting::postDatabaseResetWizardSubmit');