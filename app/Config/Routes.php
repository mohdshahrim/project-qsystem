<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::pageLogin');
$routes->get('/uploads/fragment/(:any)', 'StaticFiles::serveFragment/$1');

// system admin operations
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/user-accounts', 'AdminController::pageUserAccounts');
$routes->get('/admin/user-accounts/new', 'AdminController::pageUserAccountsNew');
$routes->post('/admin/user-accounts/create', 'AdminController::postUserAccountsCreate');
$routes->get('/admin/user-accounts/edit/(:num)', 'AdminController::pageUserAccountsEdit/$1');
$routes->post('/admin/user-accounts/update', 'AdminController::postUserAccountsUpdate');
$routes->get('/admin/user-accounts/confirm-delete/(:num)', 'AdminController::pageUserAccountsConfirmDelete/$1');
$routes->post('/admin/user-accounts/delete', 'AdminController::postUserAccountsDelete');
$routes->post('/admin/clear-all-session', 'AdminController::postClearAllSession');
$routes->get('/admin/database', 'AdminController::pageDatabase');
$routes->post('/admin/database/restore-db', 'AdminController::postRestoreDB');
$routes->post('/admin/database/backup-db', 'AdminController::postBackupDB');

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
$routes->get('/fragment/setting', 'FragmentController::pageSetting');
$routes->post('/fragment/setting/pc', 'FragmentController::postFragmentSettingPC');
$routes->get('/fragment/pc', 'FragmentController::pagePC');
$routes->get('/fragment/pc/new', 'FragmentController::pagePCNew');
$routes->post('/fragment/pc/create', 'FragmentController::postPCCreate');
$routes->get('/fragment/pc/view/(:num)', 'FragmentController::pagePCView/$1');
$routes->get('/fragment/pc/edit/(:num)', 'FragmentController::pagePCEdit/$1');
$routes->post('/fragment/pc/update', 'FragmentController::postPCUpdate');
$routes->post('/fragment/pc/delete', 'FragmentController::postPCDelete');
$routes->post('/fragment/pc/picture/create', 'FragmentController::postPCPictureCreate');
$routes->post('/fragment/pc/picture/delete', 'FragmentController::postPCPictureDelete');
$routes->get('/fragment/pc/x-transfer/(:num)/(:alpha)', 'FragmentController::xPCTransfer/$1/$2'); // special case
$routes->get('/fragment/office', 'FragmentController::pageOffice');
$routes->get('/fragment/office/edit/(:num)', 'FragmentController::pageOfficeEdit/$1');
$routes->post('/fragment/office/update', 'FragmentController::postOfficeUpdate');
$routes->get('/fragment/device', 'FragmentController::pageDevice');
$routes->get('/fragment/device/new', 'FragmentController::pageDeviceNew');
$routes->post('/fragment/device/create', 'FragmentController::postDeviceCreate');
$routes->get('/fragment/device/view/(:num)', 'FragmentController::pageDeviceView/$1');
$routes->get('/fragment/device/edit/(:num)', 'FragmentController::pageDeviceEdit/$1');
$routes->post('/fragment/device/update', 'FragmentController::postDeviceUpdate');
$routes->post('/fragment/device/delete', 'FragmentController::postDeviceDelete');
$routes->get('/fragment/about', 'FragmentController::pageAbout');

// Qrat
$routes->get('/qrat', 'Qrat::index');
$routes->post('/qrat/c', 'Qrat::postC');

// TEST
$routes->get('/testme', 'Home::testme');
$routes->get('/testgeneral', 'Home::testgeneral');
$routes->get('/testdb', 'Home::testdb');
$routes->get('/testforge', 'Home::testforge');
$routes->get('/testmodel', 'Home::testmodel');
$routes->get('/testhash', 'Home::testhash');
