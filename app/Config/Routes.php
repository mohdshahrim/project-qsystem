<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::pageLogin');
$routes->get('/uploads/fragment/(:any)', 'StaticFiles::serveFragment/$1');
$routes->get('/getalltemp', 'Home::getAllTemp');

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


// Report Delivery Status
$routes->get('/rds', 'RdsController::index');
$routes->get('/rds/setting', 'RdsController::pageSetting');
$routes->get('/rds/mill', 'RdsController::pageMill');
$routes->get('/rds/mill/new', 'RdsController::pageMillNew');
$routes->post('/rds/mill/create', 'RdsController::postMillCreate');
$routes->get('/rds/mill/edit/(:num)', 'RdsController::pageMillEdit/$1');
$routes->post('/rds/mill/update', 'RdsController::postMillUpdate');
$routes->post('/rds/mill/delete', 'RdsController::postMillDelete');
$routes->get('/rds/licensee', 'RdsController::pageLicensee');
$routes->get('/rds/licensee/new', 'RdsController::pageLicenseeNew');
$routes->post('/rds/licensee/create', 'RdsController::postLicenseeCreate');
$routes->get('/rds/licensee/edit/(:num)', 'RdsController::pageLicenseeEdit/$1');
$routes->post('/rds/licensee/update', 'RdsController::postLicenseeUpdate');
$routes->post('/rds/licensee/delete', 'RdsController::postLicenseeDelete');
$routes->get('/rds/mr', 'RdsController::pageMR');
$routes->get('/rds/api/mr/get', 'RdsController::apiMRGet');
$routes->post('/rds/api/mr/create', 'RdsController::apiMRCreate');
$routes->post('/rds/api/mr/delete', 'RdsController::apiMRDelete');
$routes->get('/rds/mr/new', 'RdsController::pageMRNew');
$routes->post('/rds/mr/create', 'RdsController::postMRCreate');
$routes->get('/rds/mr/edit', 'RdsController::pageMREdit');
$routes->get('/rds/mr/update', 'RdsController::postMRUpdate');
$routes->post('/rds/mr/delete', 'RdsController::postMRDelete');
$routes->get('/rds/lr', 'RdsController::pageLR');
$routes->get('/rds/lr/new', 'RdsController::pageLRNew');
$routes->post('/rds/lr/create', 'RdsController::postLRCreate');
$routes->get('/rds/lr/edit', 'RdsController::pageLREdit');
$routes->get('/rds/lr/update', 'RdsController::postLRUpdate');
$routes->post('/rds/lr/delete', 'RdsController::postLRDelete');
// RDS printing
$routes->get('/rds/print/(:num)', 'Public\RdsController::pagePrint/$1');
// RDS api
$routes->get('/rds/api/lr/get', 'RdsController::apiLRGet');
$routes->post('/rds/api/lr/create', 'RdsController::apiLRCreate');
$routes->post('/rds/api/lr/delete', 'RdsController::apiLRDelete');
// public facing RDS
$routes->get('/public/rds', 'Public\RdsController::index');
$routes->get('/public/rds/lr', 'Public\RdsController::pageLR');
$routes->get('/public/rds/mr', 'Public\RdsController::pageMR');
$routes->get('/public/rds/licensee', 'Public\RdsController::pageLicensee');
$routes->get('/public/rds/mill', 'Public\RdsController::pageMill');

// eLeave Checker = ec
$routes->get('/public/ec', 'EcController::index');

// Router Reset Record = rr
$routes->get('/rr', 'RouterResetController::index');
$routes->get('/rr/setting', 'RouterResetController::pageSetting');
$routes->get('/rr/action/new', 'RouterResetController::pageActionNew');
$routes->post('/rr/action/create', 'RouterResetController::postActionCreate');
$routes->post('/rr/action/delete', 'RouterResetController::postActionDelete');
$routes->get('/rr/log/new', 'RouterResetController::pageLogNew');
$routes->post('/rr/log/create', 'RouterResetController::postLogCreate');

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
