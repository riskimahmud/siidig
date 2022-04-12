<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Frontend');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Frontend::landing');
$routes->get('/home', 'Frontend::index');
$routes->get('/statistik', 'Frontend::statistik');
$routes->get('/course', 'Frontend::pelatihan');
$routes->get('/course/(:any)', 'Frontend::pelatihan/$1');
$routes->get('/berita', 'Frontend::berita');
$routes->get('/berita/(:any)', 'Frontend::berita/$1');
$routes->get('/get-informasi', 'Informasi::get_info');
$routes->get('/info-halal', 'Frontend::halal');
$routes->get('/info-kemasan', 'Frontend::kemasan');
$routes->get('/info-siinas', 'Frontend::siinas');
$routes->post('/kontak', 'Frontend::kontak');
$routes->post('/login', 'Login::do_login');
$routes->get('/logout', 'Login::logout');

$routes->get('/beranda', 'Backend::index');
$routes->get('/testing', 'Backend::coba');
// $routes->get('/testing', 'Backend::testing');
// $routes->get('/laporan', 'Laporan::index');
// $routes->add('/cari_laporan', 'Laporan::cari');
// $routes->add('/cetak_laporan', 'Laporan::cetak');
$routes->add('/profil', 'Backend::profil');

// $routes->add('/laporan', 'Admin::laporan');
// $routes->add('/cari_laporan', 'Admin::cari_laporan');

$routes->get('/grafik', 'Statistik::index', ['filter' => 'auth']);

$routes->group('/', ['filter' => 'admin'], function ($routes) { // untuk admin
    $routes->get('kontak', 'Backend::kontak');
    $routes->get('get-kontak/(:num)', 'Backend::detail_kontak/$1');

    $routes->add('users', 'Users::index');
    $routes->add('users/tambah', 'Users::tambah');
    $routes->add('users/ubah/(:num)', 'Users::ubah/$1');
    $routes->add('users/hapus/(:num)', 'Users::hapus/$1');
    $routes->add('users/reset_pass/(:num)', 'Users::reset_password/$1');
    $routes->add('users/toggle/(:num)', 'Users::toggle_status/$1');

    $routes->add('kabkota', 'Kabkota::index');

    $routes->get('siinas', 'Siinas::index');
    $routes->get('siinas/tambah', 'Siinas::tambah');
    $routes->post('siinas/tambah', 'Siinas::store');
    $routes->get('siinas/ubah/(:num)', 'Siinas::ubah/$1');
    $routes->post('siinas/ubah', 'Siinas::update');
    $routes->delete('siinas/(:num)', 'Siinas::hapus/$1');

    $routes->get('fas-halal', 'Halal::index');
    $routes->get('fas-halal/tambah', 'Halal::tambah');
    $routes->post('fas-halal/tambah', 'Halal::store');
    $routes->get('fas-halal/ubah/(:num)', 'Halal::ubah/$1');
    $routes->post('fas-halal/ubah', 'Halal::update');
    $routes->delete('fas-halal/(:num)', 'Halal::hapus/$1');

    $routes->get('fas-kemasan', 'Kemasan::index');
    $routes->get('fas-kemasan/tambah', 'Kemasan::tambah');
    $routes->post('fas-kemasan/tambah', 'Kemasan::store');
    $routes->get('fas-kemasan/ubah/(:num)', 'Kemasan::ubah/$1');
    $routes->post('fas-kemasan/ubah', 'Kemasan::update');
    $routes->delete('fas-kemasan/(:num)', 'Kemasan::hapus/$1');

    $routes->get('informasi', 'Informasi::index');
    $routes->get('informasi/ubah/(:num)', 'Informasi::ubah/$1');
    $routes->post('informasi/ubah', 'Informasi::update');

    $routes->get('blog', 'Blog::index');
    $routes->get('blog/tambah', 'Blog::tambah');
    $routes->post('blog/tambah', 'Blog::store');
    $routes->get('blog/ubah/(:num)', 'Blog::ubah/$1');
    $routes->post('blog/ubah', 'Blog::update');
    $routes->delete('blog/(:num)', 'Blog::hapus/$1');

    $routes->get('pelatihan', 'Pelatihan::index');
    $routes->get('pelatihan/tambah', 'Pelatihan::tambah');
    $routes->post('pelatihan/tambah', 'Pelatihan::store');
    $routes->get('pelatihan/ubah/(:num)', 'Pelatihan::ubah/$1');
    $routes->post('pelatihan/ubah', 'Pelatihan::update');
    $routes->delete('pelatihan/(:num)', 'Pelatihan::hapus/$1');

    $routes->get('aplikasi', 'Aplikasi::index');
    $routes->get('aplikasi/tambah', 'Aplikasi::tambah');
    $routes->post('aplikasi/tambah', 'Aplikasi::store');
    $routes->get('aplikasi/ubah/(:num)', 'Aplikasi::ubah/$1');
    $routes->post('aplikasi/ubah', 'Aplikasi::update');
    $routes->delete('aplikasi/(:num)', 'Aplikasi::hapus/$1');

    $routes->get('header', 'Header::index');
    $routes->get('header/tambah', 'Header::tambah');
    $routes->post('header/tambah', 'Header::store');
    $routes->get('header/ubah/(:num)', 'Header::ubah/$1');
    $routes->post('header/ubah', 'Header::update');
    $routes->delete('header/(:num)', 'Header::hapus/$1');

    $routes->get('laporan', 'Admin::laporan_investasi');
    $routes->get('laporan/(:num)', 'Admin::laporan_investasi_detail/$1');
    $routes->post('laporan', 'Admin::cetak_investasi');
});
$routes->group('/', ['filter' => 'user'], function ($routes) { // untuk user
    // kelurahan kecamatan
    $routes->get('kelkec', 'KelKec::index');
    $routes->get('kelkec/tambah', 'KelKec::tambah');
    $routes->post('kelkec/tambah', 'KelKec::store');
    $routes->get('kelkec/ubah/(:num)', 'Kelkec::ubah/$1');
    $routes->post('kelkec/ubah', 'Kelkec::update');
    $routes->get('users/hapus/(:num)', 'Kelkec::hapus/$1');

    // investasi
    $routes->add('investasi', 'LaporanInvestasi::index');
    // $routes->get('investasi', 'LaporanInvestasi::index');
    $routes->get('investasi/tambah', 'LaporanInvestasi::tambah');
    $routes->post('investasi/tambah', 'LaporanInvestasi::store');
    $routes->get('investasi/ubah/(:num)', 'LaporanInvestasi::ubah/$1');
    $routes->post('investasi/ubah', 'LaporanInvestasi::update');
    $routes->get('investasi/hapus/(:num)', 'LaporanInvestasi::hapus/$1');
    $routes->get('investasi/import', 'LaporanInvestasi::import');
    $routes->post('investasi/import', 'LaporanInvestasi::do_import');

    // hapus investasi berdasarkan tabel
    $routes->post('hapus-investasi', 'LaporanInvestasi::hapus_semua');

    $routes->add('investasi/(:num)', 'LaporanInvestasi::detail/$1');

    // download template investasi
    $routes->post('download-template-investasi', 'LaporanInvestasi::download_template');

    $routes->post('getKelurahan', 'LaporanInvestasi::get_kelurahan');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
