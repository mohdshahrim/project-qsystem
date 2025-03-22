<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::pageLogin');

// system admin operations
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/user-accounts', 'Admin::pageUserAccounts');
$routes->get('/admin/user-accounts/new', 'Admin::pageUserAccountsNew');
$routes->post('/admin/user-accounts/create', 'Admin::postUserAccountsCreate');
$routes->get('/admin/user-accounts/edit/(:num)', 'Admin::pageUserAccountsEdit/$1');
$routes->post('/admin/user-accounts/update', 'Admin::postUserAccountsUpdate');
$routes->get('/admin/user-accounts/confirm-delete/(:num)', 'Admin::pageUserAccountsConfirmDelete/$1');
$routes->post('/admin/user-accounts/delete', 'Admin::postUserAccountsDelete');
$routes->post('/admin/clear-all-session', 'Admin::postClearAllSession');
$routes->post('/admin/restore-db', 'Admin::postRestoreDB');
$routes->post('/admin/backup-db', 'Admin::postBackupDB');


// User operations
$routes->post('/user/login', 'User::postLogin');
$routes->get('/user/logout', 'User::postLogout');
$routes->get('/user/home', 'User::pageHome');
$routes->get('/user/account', 'User::pageUserAccount');
$routes->post('/user/password/update', 'User::postPasswordUpdate'); //STANDARD

// Claimmaker app
$routes->get('/claimmaker', 'Claimmaker::index');
$routes->post('/claimmaker/c', 'Claimmaker::postCreate');
$routes->get('/claimmaker/r/(:alphanum)', 'Claimmaker::pageRead/$1');
$routes->get('/claimmaker/history', 'Claimmaker::pageHistory');

// Fragment system
$routes->get('/fragment', 'FragmentController::index');
$routes->get('/fragment/pc', 'FragmentController::pagePC');

// Qrat
$routes->get('/qrat', 'Qrat::index');
$routes->post('/qrat/c', 'Qrat::postC');

// TEST
$routes->get('/testgeneral', 'Home::testgeneral');
$routes->get('/testdb', 'Home::testdb');
$routes->get('/testforge', 'Home::testforge');
$routes->get('/testmodel', 'Home::testmodel');
$routes->get('/testhash', 'Home::testhash');
