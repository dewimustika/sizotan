<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pemetaan::zonarawan');
$routes->get('/pengaduan', 'Pages::pengaduan');
$routes->get('/backend', 'Pemetaan::backend');
$routes->get('/kelolapengaduan', 'Pages::kelolapengaduan');
$routes->get('/hapuspengaduan', 'Pages::hapuspengaduan');
$routes->get('/tambahzona', 'Pemetaan::tambahzonarawan');
$routes->get('/pemetaan', 'Pemetaan::index');
$routes->get('/editzona/(:num)', 'Pemetaan::editzona/$1');
$routes->post('/editzona/(:num)', 'Pemetaan::editzona/$1');
$routes->get('detailzona/(:num)', 'Pemetaan::detailZona/$1');
$routes->group('zonarawan', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'EditZona::index');
    $routes->get('create', 'EditZona::create');
    $routes->post('create', 'EditZona::store');
    $routes->get('edit/(:num)', 'EditZona::edit/$1');
    $routes->post('edit/(:num)', 'EditZona::update/$1');
    $routes->get('delete/(:num)', 'EditZona::delete/$1');
});
$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('login', 'Auth::login');
    $routes->add('logout', 'Auth::logout');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
