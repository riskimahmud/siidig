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
$routes->setDefaultController('Login');
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
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::do_login');
$routes->get('/logout', 'Login::logout');

$routes->get('/beranda', 'Backend::index');
$routes->get('/testing', 'Backend::coba');
$routes->get('/cek_tmt', 'Backend::cek_tmt');
$routes->get('/cek_spt/(:any)', 'Backend::cek_spt/$1');
$routes->get('/cek-spt', 'Admin::cek_spt_admin');
// $routes->get('/testing', 'Backend::testing');
// $routes->get('/laporan', 'Laporan::index');
// $routes->add('/cari_laporan', 'Laporan::cari');
// $routes->add('/cetak_laporan', 'Laporan::cetak');
$routes->add('/profil', 'Backend::profil');
$routes->add('/detail-jabatan/(:num)', 'Jabatan::detail/$1');
$routes->add('/ajukan-jabatan/(:num)', 'Jabatan::ajukan/$1');

$routes->add('/tmt', 'Admin::masuk_tmt');
$routes->add('/sinkron', 'Admin::sinkron_simpeg');

$routes->add('/laporan', 'Admin::laporan');
$routes->add('/cari_laporan', 'Admin::cari_laporan');

$routes->add('ajax/cari-pegawai-by-skpd', 'Ajax::cari_pegawai_by_skpd');
$routes->add('ajax/cari-jabatan-by-skpd', 'Ajax::cari_jabatan_by_skpd');
$routes->add('ajax/cari-spt-by-id', 'Ajax::cari_spt');

$routes->add('/spt-pelantikan', 'Admin::daftar_pelantikan');
$routes->add('/spt-pelantikan/buat', 'Admin::buat_pelantikan');
$routes->add('/spt-pelantikan/(:any)/sinkron', 'Admin::sinkron_simpeg_pelantikan/$1');
$routes->add('/spt-pelantikan/(:any)/cetak', 'Admin::cetak_pelantikan/$1/$2');
$routes->add('/spt-pelantikan/(:any)/selesai', 'Admin::selesai_pelantikan/$1');
$routes->add('/spt-pelantikan/(:any)/ubah', 'Admin::ubah_pelantikan/$1');
$routes->add('/spt-pelantikan/(:any)/hapus', 'Admin::hapus_pelantikan/$1');
$routes->add('/spt-pelantikan/(:any)/tambah-pegawai', 'Admin::tambah_pegawai/$1');
$routes->add('/spt-pelantikan/(:any)/ubah-pegawai/(:any)', 'Admin::ubah_pegawai/$1/$2');
$routes->add('/spt-pelantikan/(:any)/hapus-pegawai/(:any)', 'Admin::hapus_pegawai/$1/$2');
$routes->add('/spt-pelantikan/(:any)/cetak-petikan/(:any)', 'Admin::cetak_petikan/$1/$2');
$routes->add('/spt-pelantikan/(:any)', 'Admin::detail_pelantikan/$1');


$routes->add('/spt', 'Admin::daftar_spt');
$routes->add('/spt/hapus_filter', 'Admin::hapus_filter/spt');
$routes->add('/spt/filter', 'Admin::filter/spt');
$routes->add('/spt/buat', 'Admin::buat_pengajuan');
$routes->add('/spt/buat-khusus', 'Admin::buat_pengajuan_khusus');
$routes->add('/ajax/cari-pegawai', 'Opd::cari_pegawai');
$routes->add('/spt/cari-jabatan', 'Admin::cari_jabatan_kosong');
$routes->add('/spt/(:any)/ubah-data-sk', 'Admin::ubah_sk/$1');
$routes->add('/spt/(:any)', 'Admin::detail_pengajuan/$1');


$routes->add('/pengajuan', 'Admin::pengajuan');
$routes->add('/pengajuan/buat', 'Admin::buat_pengajuan');
$routes->add('/pengajuan/filter', 'Admin::filter');
$routes->add('/pengajuan/hapus_filter', 'Admin::hapus_filter');
$routes->add('/pengajuan/unggah-spt', 'Admin::unggah_spt');
$routes->add('/pengajuan/tolak-pengajuan', 'Admin::tolak_pengajuan');
$routes->add('/pengajuan/(:alpha)', 'Admin::pengajuan/$1');
$routes->add('/pengajuan/(:any)/proses-pengajuan', 'Admin::proses_pengajuan/$1');
$routes->add('/pengajuan/(:any)/setujui-pengajuan', 'Admin::setujui_pengajuan/$1');
$routes->add('/pengajuan/(:any)/ubah-data-sk', 'Admin::ubah_sk/$1');
$routes->add('/pengajuan/(:any)/selesai', 'Admin::cetak/$1');
$routes->add('/pengajuan/(:any)/print', 'Admin::cetak/$1');
$routes->add('/pengajuan/(:any)', 'Admin::detail_pengajuan/$1');

$routes->group('/', ['filter' => 'admin'], function ($routes) { // untuk admin
    $routes->add('users', 'Users::index');
    $routes->add('users/tambah', 'Users::tambah');
    $routes->add('users/ubah/(:num)', 'Users::ubah/$1');
    $routes->add('users/hapus/(:num)', 'Users::hapus/$1');
    $routes->add('users/reset_pass/(:num)', 'Users::reset_password/$1');
    $routes->add('users/toggle/(:num)', 'Users::toggle_status/$1');
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

    $routes->add('investasi/(:num)', 'LaporanInvestasi::detail/$1');

    // download template investasi
    $routes->post('download-template-investasi', 'LaporanInvestasi::download_template');
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
