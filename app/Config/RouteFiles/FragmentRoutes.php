<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/fragment', 'Fragment::index');
$routes->get('/fragment/pc', 'Fragment::pagePC');
$routes->get('/fragment/pc/new', 'Fragment::pagePCNew');

$routes->get('/fragment/site', 'Fragment::pageSite');
$routes->get('/fragment/site/(:num)', 'Fragment::pageSiteRead/$1');
$routes->get('/fragment/site/new', 'Fragment::pageSiteNew');
$routes->post('/fragment/site/create', 'Fragment::postSiteCreate');
$routes->get('/fragment/site/edit/(:num)', 'Fragment::pageSiteEdit/$1');
$routes->post('/fragment/site/update', 'Fragment::postSiteUpdate');
$routes->post('/fragment/site/delete', 'Fragment::postSiteDelete');

$routes->get('/fragment/staff', 'Fragment::pageStaff');
$routes->get('/fragment/staff/(:num)', 'Fragment::pageStaffRead/$1');
$routes->get('/fragment/staff/new', 'Fragment::pageStaffNew');
$routes->post('/fragment/staff/create', 'Fragment::postStaffCreate');
$routes->get('/fragment/staff/edit/(:num)', 'Fragment::pageStaffEdit/$1');
$routes->post('/fragment/staff/update', 'Fragment::postStaffUpdate');
$routes->post('/fragment/staff/delete', 'Fragment::postStaffDelete');

$routes->get('/fragment/designation', 'Fragment::pageDesignation');
//$routes->get('/fragment/designation/(:num)', 'Fragment::pageDesignationRead/$1');
//$routes->get('/fragment/designation/new', 'Fragment::pageDesignationNew');
$routes->post('/fragment/designation/create', 'Fragment::postDesignationCreate');
//$routes->get('/fragment/designation/edit/(:num)', 'Fragment::pageDesignationEdit/$1');
$routes->post('/fragment/designation/update', 'Fragment::postDesignationUpdate');
$routes->post('/fragment/designation/delete', 'Fragment::postDesignationDelete');

$routes->get('/fragment/department', 'Fragment::pageDepartment');
$routes->post('/fragment/department/create', 'Fragment::postDepartmentCreate');
$routes->post('/fragment/department/update', 'Fragment::postDepartmentUpdate');
$routes->post('/fragment/department/delete', 'Fragment::postDepartmentDelete');