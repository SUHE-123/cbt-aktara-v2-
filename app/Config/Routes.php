<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('/', 'Auth::login');
$routes->get('/', 'Admin\Dashboard::index');
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    
    // Tambahkan rute lainnya di sini nanti
});

$routes->group('admin', ['filter' => 'authadmin'], function ($routes) {
    
    // Route untuk Users (User Management)
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/create', 'Admin\Users::create');
    $routes->post('users/store', 'Admin\Users::store');
    $routes->get('users/edit/(:num)', 'Admin\Users::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\Users::update/$1');
    $routes->post('users/delete/(:num)', 'Admin\Users::delete/$1');

    // ...rute lainnya seperti siswa, guru, mapel, dll

});



$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');
    
$routes->group('admin', ['filter' => 'authadmin'], function ($routes) {
$routes->get('dashboard', 'Admin\Dashboard::index');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('profil', 'Profil::index');
    $routes->post('profil/update', 'Profil::update');
});

// Routes untuk Sekolah (di dalam grup 'admin')
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('sekolah', 'Sekolah::index'); // Tampilkan daftar sekolah
    $routes->get('sekolah/create', 'Sekolah::create'); // Form tambah
    $routes->post('sekolah/store', 'Sekolah::store'); // Proses simpan

    $routes->get('sekolah/edit/(:num)', 'Sekolah::edit/$1'); // Form edit
    $routes->post('sekolah/update/(:num)', 'Sekolah::update/$1'); // Proses update

    $routes->get('sekolah/delete/(:num)', 'Sekolah::delete/$1'); // Proses hapus
});


// Routes untuk Siswa
$routes->group('admin', function($routes) {
    $routes->get('siswa', 'Admin\Siswa::index');
    $routes->get('siswa/create', 'Admin\Siswa::create');
    $routes->post('siswa/store', 'Admin\Siswa::store');
    $routes->get('siswa/edit/(:num)', 'Admin\Siswa::edit/$1');
    $routes->post('siswa/update/(:num)', 'Admin\Siswa::update/$1');
    $routes->post('siswa/delete/(:num)', 'Admin\Siswa::delete/$1');

    $routes->get('guru', 'Admin\Guru::index');
    $routes->get('guru/create', 'Admin\Guru::create');
    $routes->post('guru/store', 'Admin\Guru::store');
    $routes->get('guru/edit/(:num)', 'Admin\Guru::edit/$1');
    $routes->post('guru/update/(:num)', 'Admin\Guru::update/$1');
    $routes->post('guru/delete/(:num)', 'Admin\Guru::delete/$1');
});

// Mata Pelajaran
$routes->group('admin/mapel', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'Mapel::index'); 
    $routes->get('create', 'Mapel::create'); 
    $routes->post('store', 'Mapel::store'); 
    $routes->get('edit/(:num)', 'Mapel::edit/$1'); 
    $routes->post('update/(:num)', 'Mapel::update/$1'); 
    $routes->post('delete/(:num)', 'Mapel::delete/$1'); 
});

// Jenis Buku
$routes->group('admin', ['filter' => 'authadmin'], function($routes) {
    $routes->get('jenisbuku', 'Admin\JenisBuku::index');
    $routes->get('jenisbuku/create', 'Admin\JenisBuku::create');
    $routes->post('jenisbuku/store', 'Admin\JenisBuku::store');
    $routes->get('jenisbuku/edit/(:num)', 'Admin\JenisBuku::edit/$1');
    $routes->post('jenisbuku/update/(:num)', 'Admin\JenisBuku::update/$1');
    $routes->post('jenisbuku/delete/(:num)', 'Admin\JenisBuku::delete/$1');
});

// Koleksi Buku
$routes->group('admin', ['filter'=>'authadmin'], function($routes){
    $routes->get('koleksibuku',                'Admin\KoleksiBuku::index');
    $routes->get('koleksibuku/create',         'Admin\KoleksiBuku::create');
    $routes->post('koleksibuku/store',         'Admin\KoleksiBuku::store');
    $routes->get('koleksibuku/edit/(:num)',    'Admin\KoleksiBuku::edit/$1');
    $routes->post('koleksibuku/update/(:num)', 'Admin\KoleksiBuku::update/$1');
    $routes->post('koleksibuku/delete/(:num)', 'Admin\KoleksiBuku::delete/$1');
});

// Routes untuk Jenis Ujian
$routes->group('admin/jenisujian', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'JenisUjian::index');
    $routes->get('create', 'JenisUjian::create');
    $routes->post('store', 'JenisUjian::store');
    $routes->get('edit/(:num)', 'JenisUjian::edit/$1');
    $routes->post('update/(:num)', 'JenisUjian::update/$1');
    $routes->post('delete/(:num)', 'JenisUjian::delete/$1');
});

// Routes untuk Sesi Ujian
$routes->get('/admin/sesiujian', 'Admin\SesiUjian::index');
$routes->get('/admin/sesiujian/create', 'Admin\SesiUjian::create');
$routes->post('/admin/sesiujian/store', 'Admin\SesiUjian::store');
$routes->get('/admin/sesiujian/edit/(:num)', 'Admin\SesiUjian::edit/$1');
$routes->post('/admin/sesiujian/update/(:num)', 'Admin\SesiUjian::update/$1');
$routes->post('/admin/sesiujian/delete/(:num)', 'Admin\SesiUjian::delete/$1');

// Routes untuk Nomor Peserta
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('nomorpeserta', 'NomorPeserta::index');
    $routes->get('nomorpeserta/create', 'NomorPeserta::create');
    $routes->post('nomorpeserta/store', 'NomorPeserta::store');
    $routes->get('nomorpeserta/edit/(:num)', 'NomorPeserta::edit/$1');
    $routes->post('nomorpeserta/update/(:num)', 'NomorPeserta::update/$1');
    $routes->post('nomorpeserta/delete/(:num)', 'NomorPeserta::delete/$1');
});

$routes->group('admin', function($routes) {
    // Bank Soal
    $routes->get('banksoal', 'Admin\BankSoal::index');
    $routes->get('banksoal/create', 'Admin\BankSoal::create');
    $routes->post('banksoal/store', 'Admin\BankSoal::store');
    $routes->get('banksoal/edit/(:num)', 'Admin\BankSoal::edit/$1');
    $routes->post('banksoal/update/(:num)', 'Admin\BankSoal::update/$1');
    $routes->post('banksoal/delete/(:num)', 'Admin\BankSoal::delete/$1');
});

// Routes untuk Jadwal Ujian
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('jadwalujian',              'JadwalUjian::index');
    $routes->get('jadwalujian/create',       'JadwalUjian::create');
    $routes->post('jadwalujian/store',       'JadwalUjian::store');
    $routes->get('jadwalujian/edit/(:num)',  'JadwalUjian::edit/$1');
    $routes->post('jadwalujian/update/(:num)','JadwalUjian::update/$1');
    $routes->post('jadwalujian/delete/(:num)','JadwalUjian::delete/$1');
});

// Routes untuk Alokasi Waktu Ujian
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('alokasiwaktu', 'AlokasiWaktuController::index');
    $routes->get('alokasiwaktu/create', 'AlokasiWaktuController::create');
    $routes->post('alokasiwaktu/store', 'AlokasiWaktuController::store');
    $routes->get('alokasiwaktu/edit/(:num)', 'AlokasiWaktuController::edit/$1');
    $routes->post('alokasiwaktu/update/(:num)', 'AlokasiWaktuController::update/$1');
    $routes->post('alokasiwaktu/delete/(:num)', 'AlokasiWaktuController::delete/$1');
});

// Routes untuk Token Ujian
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('token', 'TokenUjianController::index');
    $routes->post('token/generate', 'TokenUjianController::generate');
});

// Routes untuk Kartu Peserta Ujian
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('kartupeserta', 'KartuPesertaController::index');
    $routes->get('admin/kartupeserta/pdf', 'Admin\KartuPesertaController::pdf');

});

// Routes untuk Status Ujian
$routes->group('admin', ['filter' => 'authadmin'], function($routes) {
    $routes->get('statusujian', 'Admin\StatusUjianController::index');
});

// Hasil Ujian - Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('hasilujian', 'hasilujiancontroller::index');
    $routes->get('hasilujian/detail/(:num)', 'hasilujiancontroller::detail/$1');
});

// Routes analisa soal
$routes->group('admin', ['filter' => 'authadmin'], function($routes) {
    $routes->get('analisasoal', 'Admin\AnalisaSoalController::index');
});

// Rekap Nilai Ujian
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('rekapnilai', 'RekapNilaiController::index');
    $routes->get('rekapnilai/pdf', 'RekapNilaiController::downloadPDF');

});

// Routes untuk Soal
$routes->get('admin/soal/(:num)', 'Admin\SoalController::index/$1');



//============Routes untuk guru============//
$routes->group('guru', ['filter' => 'authguru', 'namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
});

$routes->group('guru', ['filter' => 'authguru'], function($routes) {
    $routes->get('profil', 'Guru\Profil::index');
    $routes->post('profil/update', 'Guru\Profil::update');
});


// Jenis Buku
$routes->group('guru', ['filter' => 'authguru'], function($routes) {
    $routes->get('jenisbuku', 'Guru\JenisBuku::index');
    $routes->get('jenisbuku/create', 'Guru\JenisBuku::create');
    $routes->post('jenisbuku/store', 'Guru\JenisBuku::store');
    $routes->get('jenisbuku/edit/(:num)', 'Guru\JenisBuku::edit/$1');
    $routes->post('jenisbuku/update/(:num)', 'Guru\JenisBuku::update/$1');
    $routes->post('jenisbuku/delete/(:num)', 'Guru\JenisBuku::delete/$1');
});

// Koleksi Buku
$routes->group('guru', ['filter'=>'authguru'], function($routes){
    $routes->get('koleksibuku',                'Guru\KoleksiBuku::index');
    $routes->get('koleksibuku/create',         'Guru\KoleksiBuku::create');
    $routes->post('koleksibuku/store',         'Guru\KoleksiBuku::store');
    $routes->get('koleksibuku/edit/(:num)',    'Guru\KoleksiBuku::edit/$1');
    $routes->post('koleksibuku/update/(:num)', 'Guru\KoleksiBuku::update/$1');
    $routes->post('koleksibuku/delete/(:num)', 'Guru\KoleksiBuku::delete/$1');
});

// Routes untuk Siswa
$routes->group('guru', function($routes) {
    $routes->get('siswa', 'Guru\Siswa::index');
    $routes->get('siswa/create', 'Guru\Siswa::create');
    $routes->post('siswa/store', 'Guru\Siswa::store');
    $routes->get('siswa/edit/(:num)', 'Guru\Siswa::edit/$1');
    $routes->post('siswa/update/(:num)', 'Guru\Siswa::update/$1');
    $routes->post('siswa/delete/(:num)', 'Guru\Siswa::delete/$1');
});

// Mata Pelajaran
$routes->group('guru/mapel', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('/', 'Mapel::index'); 
    $routes->get('create', 'Mapel::create'); 
    $routes->post('store', 'Mapel::store'); 
    $routes->get('edit/(:num)', 'Mapel::edit/$1'); 
    $routes->post('update/(:num)', 'Mapel::update/$1'); 
    $routes->post('delete/(:num)', 'Mapel::delete/$1'); 
});

// Routes untuk Jenis Ujian
$routes->group('guru/jenisujian', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('/', 'JenisUjian::index');
    $routes->get('create', 'JenisUjian::create');
    $routes->post('store', 'JenisUjian::store');
    $routes->get('edit/(:num)', 'JenisUjian::edit/$1');
    $routes->post('update/(:num)', 'JenisUjian::update/$1');
    $routes->post('delete/(:num)', 'JenisUjian::delete/$1');
});

// Routes untuk Sesi Ujian
$routes->get('/guru/sesiujian', 'Guru\SesiUjian::index');
$routes->get('/guru/sesiujian/create', 'Guru\SesiUjian::create');
$routes->post('/guru/sesiujian/store', 'Guru\SesiUjian::store');
$routes->get('/guru/sesiujian/edit/(:num)', 'Guru\SesiUjian::edit/$1');
$routes->post('/guru/sesiujian/update/(:num)', 'Guru\SesiUjian::update/$1');
$routes->post('/guru/sesiujian/delete/(:num)', 'Guru\SesiUjian::delete/$1');


// Routes untuk Nomor Peserta
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('nomorpeserta', 'NomorPeserta::index');
    $routes->get('nomorpeserta/create', 'NomorPeserta::create');
    $routes->post('nomorpeserta/store', 'NomorPeserta::store');
    $routes->get('nomorpeserta/edit/(:num)', 'NomorPeserta::edit/$1');
    $routes->post('nomorpeserta/update/(:num)', 'NomorPeserta::update/$1');
    $routes->post('nomorpeserta/delete/(:num)', 'NomorPeserta::delete/$1');
});


// Bank Soal
$routes->group('guru', function($routes) {
    $routes->get('banksoal', 'Guru\BankSoal::index');
    $routes->get('banksoal/create', 'Guru\BankSoal::create');
    $routes->post('banksoal/store', 'Guru\BankSoal::store');
    $routes->get('banksoal/edit/(:num)', 'Guru\BankSoal::edit/$1');
    $routes->post('banksoal/update/(:num)', 'Guru\BankSoal::update/$1');
    $routes->post('banksoal/delete/(:num)', 'Guru\BankSoal::delete/$1');
});

// Routes untuk Soal
$routes->get('guru/soal/(:num)', 'Guru\SoalController::index/$1');

// Routes untuk Jadwal Ujian
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('jadwalujian',              'JadwalUjian::index');
    $routes->get('jadwalujian/create',       'JadwalUjian::create');
    $routes->post('jadwalujian/store',       'JadwalUjian::store');
    $routes->get('jadwalujian/edit/(:num)',  'JadwalUjian::edit/$1');
    $routes->post('jadwalujian/update/(:num)','JadwalUjian::update/$1');
    $routes->post('jadwalujian/delete/(:num)','JadwalUjian::delete/$1');
});

// Routes untuk Alokasi Waktu Ujian
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('alokasiwaktu', 'AlokasiWaktuController::index');
    $routes->get('alokasiwaktu/create', 'AlokasiWaktuController::create');
    $routes->post('alokasiwaktu/store', 'AlokasiWaktuController::store');
    $routes->get('alokasiwaktu/edit/(:num)', 'AlokasiWaktuController::edit/$1');
    $routes->post('alokasiwaktu/update/(:num)', 'AlokasiWaktuController::update/$1');
    $routes->post('alokasiwaktu/delete/(:num)', 'AlokasiWaktuController::delete/$1');
});


// Routes untuk Token Ujian
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function($routes) {
    $routes->get('token', 'TokenUjianController::index');
    $routes->post('token/generate', 'TokenUjianController::generate');
});

// Routes untuk Kartu Peserta Ujian
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function ($routes) {
    $routes->get('kartupeserta', 'KartuPesertaController::index');
    $routes->get('admin/kartupeserta/pdf', 'Admin\KartuPesertaController::pdf');

});


// Routes untuk Status Ujian
$routes->group('guru', ['filter' => 'authguru'], function($routes) {
    $routes->get('statusujian', 'Guru\StatusUjianController::index');
});


// Hasil Ujian - Admin
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function ($routes) {
    $routes->get('hasilujian', 'hasilujiancontroller::index');
    $routes->get('hasilujian/detail/(:num)', 'hasilujiancontroller::detail/$1');
});


// Routes analisa soal
$routes->group('guru', ['filter' => 'authguru'], function($routes) {
    $routes->get('analisasoal', 'Guru\AnalisaSoalController::index');
});


// Rekap Nilai Ujian
$routes->group('guru', ['namespace' => 'App\Controllers\Guru'], function ($routes) {
    $routes->get('rekapnilai', 'RekapNilaiController::index');
    $routes->get('rekapnilai/pdf', 'RekapNilaiController::downloadPDF');

});


// ========================
// ROUTES UNTUK ROLE SISWA
// ========================
$routes->group('siswa', ['filter' => 'authsiswa'], function ($routes) {
    $routes->get('dashboard', 'Siswa\Dashboard::index');
});


// Perpustakaan - Data Buku
$routes->group('siswa', ['filter' => 'authsiswa'], function($routes) {
    $routes->get('perpustakaan', 'Siswa\Perpustakaan::index');
    $routes->get('perpustakaan/baca/(:num)', 'Siswa\Perpustakaan::baca/$1');
});

// home
$routes->group('siswa', ['namespace' => 'App\Controllers\Siswa'], function($routes) {
    $routes->get('ujian', 'Home::index');
});

// Konfirmasi Ujian
$routes->group('siswa', ['namespace' => 'App\Controllers\Siswa', 'filter' => 'authsiswa'], function($routes) {
    $routes->get('ujian/konfirmasi', 'KonfirmasiUjian::index');
    $routes->post('ujian/konfirmasi', 'KonfirmasiUjian::konfirmasi');
});

$routes->group('siswa', ['namespace' => 'App\Controllers\Siswa'], function($routes) {
    $routes->get('ujian/pelaksanaan/(:num)', 'PelaksanaanUjian::index/$1');
    $routes->post('ujian/pelaksanaan/simpan-jawaban', 'PelaksanaanUjian::simpanJawaban');
});

// Hasil Ujian Siswa
$routes->group('siswa', ['namespace' => 'App\Controllers\Siswa'], function($routes) {
    $routes->get('ujian/hasil', 'HasilUjian::index');
});




