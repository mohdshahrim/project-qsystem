<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/fragment', 'Fragment::index');
$routes->get('/fragment/pc', 'Fragment::pagePc');
$routes->get('/fragment/pc/new', 'Fragment::pagePcNew');

$routes->get('/fragment/site', 'Fragment::pageSite');
$routes->get('/fragment/site/(:num)', 'Fragment::pageSiteRead/$1');
$routes->get('/fragment/site/new', 'Fragment::pageSiteNew');
$routes->post('/fragment/site/create', 'Fragment::postSiteCreate');
$routes->get('/fragment/site/edit/(:num)', 'Fragment::pageSiteEdit/$1');
$routes->post('/fragment/site/update', 'Fragment::postSiteUpdate');
$routes->post('/fragment/site/delete', 'Fragment::postSiteDelete');