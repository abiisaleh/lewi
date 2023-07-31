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
$routes->get('/', 'Home::index');
$routes->post('siswa', 'Home::siswa');

$routes->get('admin', 'Admin\Dashboard::index', ['filter' => 'role:admin,guru']);
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'role:admin'], function ($routes) {

    $routes->resource('datamaster/kelas');
    $routes->resource('datamaster/mapel');
    $routes->resource('datamaster/pelanggaran');

    $routes->resource('siswa');

    $routes->resource('guru');

    $routes->resource('akademik');
    $routes->post('akademik/walikelas', 'Akademik::walikelas');
    $routes->post('akademik/siswa', 'Akademik::siswa');
    $routes->delete('akademik-siswa/delete(:any)', 'Akademik::delete$1');

    $routes->resource('jadwal');

    $routes->group('monitor', ['namespace' => 'App\Controllers\Admin\Monitoring', 'filter' => 'role:guru'], function ($routes) {
        $routes->resource('nilai');

        $routes->get('pelanggaran', 'Pelanggaran::index');
        $routes->post('pelanggaran', 'Pelanggaran::save');

        $routes->get('absensi', 'Absensi::index');
        $routes->post('absensi', 'Absensi::save');
    });

    $routes->get('rekomendasi/beasiswa', 'Rekomendasi::beasiswa');
    $routes->post('rekomendasi/beasiswa', 'Rekomendasi::beasiswa_get');

    $routes->get('rekomendasi/prestasi', 'Rekomendasi::prestasi');
    $routes->post('rekomendasi/prestasi', 'Rekomendasi::prestasi_get');
});

$routes->group('api', function ($routes) {
    $routes->get('select2/siswa', 'Admin\Siswa::select2');
    $routes->get('select2/pelanggaran', 'Admin\Datamaster\Pelanggaran::select2');
    $routes->get('select2/guru', 'Admin\Guru::select2');
    $routes->get('select2/kelas', 'Admin\Datamaster\Kelas::select2');

    $routes->post('rekomendasi/prestasi', 'Admin\Rekomendasi::prestasi_get');
    $routes->post('rekomendasi/beasiswa', 'Admin\Rekomendasi::beasiswa_get');
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
