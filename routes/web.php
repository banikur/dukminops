<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('template.front.index');
});

// Route::get('/absence-input/{data}/{date}', 'VerifiedController@postdata')->name('logout');
Route::get('/data_map', 'VerifiedController@get_map')->name('get_map');
Route::get('/dashboard_box', 'VerifiedController@dashboard_box')->name('dashboard_box');
Route::get('/get_master_pangkat/{id}', 'VerifiedController@get_masterpangkat_id')->name('get_masterpangkat_id');
Route::get('/master_pangkat', 'VerifiedController@get_masterpangkat')->name('get_masterpangkat');
Route::post('/detail_maps', 'VerifiedController@index_detail_maps')->name('get_detail_maps');

Auth::routes();
Route::namespace('Auth')->group(function () {
    // Controllers Within The "App\Http\Controllers\Auth" Namespace
    Route::get('/login', 'LoginController@getLogin')->middleware('guest');
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::name('hrd')->middleware('auth:hrd')->group(function () {
    Route::get('/dashboard-hrd', 'HrdController@index')->name('dashboard.hrd');

    Route::namespace('master')->group(function () {
        //Master Provinsi
        Route::get('master/provinsi-dashboard', 'MasterProvinsiController@index');
        Route::post('master/provinsi-dashboard/tambah', 'MasterProvinsiController@tambah');
        Route::post('master/provinsi-dashboard/edit', 'MasterProvinsiController@edit');
        Route::get('master/provinsi-dashboard/hapus/{id}', 'MasterProvinsiController@hapus');

        //Master Pangkat
        Route::get('master/pangkat-dashboard', 'MasterPangkatController@index');
        Route::post('master/pangkat-dashboard/tambah', 'MasterPangkatController@tambah');
        Route::post('master/pangkat-dashboard/edit', 'MasterPangkatController@edit');
        Route::get('master/pangkat-dashboard/hapus/{id}', 'MasterPangkatController@hapus');

        //Master Jenis Peralatan
        Route::get('master/jenis-peralatan-dashboard', 'MasterJenisPeralatanController@index');
        Route::post('master/jenis-peralatan-dashboard/tambah', 'MasterJenisPeralatanController@tambah');
        Route::post('master/jenis-peralatan-dashboard/edit', 'MasterJenisPeralatanController@edit');
        Route::get('master/jenis-peralatan-dashboard/hapus/{id}', 'MasterJenisPeralatanController@hapus');

        Route::get('master/jenis_operasi', 'MasterJenisOperasiController@index');
        Route::post('master/jenis_operasi/tambah', 'MasterJenisOperasiController@tambah');
        Route::post('master/jenis_operasi/edit', 'MasterJenisOperasiController@edit');
        Route::get('master/jenis_operasi/hapus/{id}', 'MasterJenisOperasiController@hapus');
    });
    Route::get('/tambah-operasi-pusat', 'InputDataController@add_operasi_index')->name('admin.add_operasi');
    Route::get('/list-operasi-all', 'InputDataController@data_entry')->name('admin.list-operasi');
    Route::get('/list-operasi-all/detail/{id}', 'InputDataController@detail_operasi')->name('admin.detail_operasi');
    Route::get('/list-operasi-all/edit/{id}', 'InputDataController@edit_operasi')->name('admin.edit_operasi');
    Route::get('/list-operasi-all/hapus/{id}', 'InputDataController@hapus_operasi')->name('admin.hapus_operasi');

    //user management
    Route::get('/user-management', 'UserManagementController@index');
    Route::get('/user-management/prov', 'UserManagementController@getProvinsi');
    Route::post('/user-management/edit', 'UserManagementController@edit');

    Route::post('/pusat/store_data', 'InputDataController@store_data');
    Route::post('/pusat/update_data', 'InputDataController@update_data');
    Route::get('/pusat/entry-operasi/prov', 'InputDataController@getProvinsi')->name('getprovinsi.user');
});

Route::name('user')->middleware('auth:user')->group(function () {
    Route::get('/dashboard-user', 'InputDataController@index')->name('dashboard.user');
    Route::get('/tambah-operasi', 'InputDataController@add_operasi_index')->name('add_operasi_index.user');
    Route::get('/entry-operasi/detail/{id}', 'InputDataController@detail_operasi')->name('detail_operasi.user');
    Route::get('/entry-operasi/edit/{id}', 'InputDataController@edit_operasi')->name('edit_operasi.user');
    Route::get('/entry-operasi/hapus/{id}', 'InputDataController@hapus_operasi')->name('hapus_operasi.user');
    Route::get('/entry-operasi/prov', 'InputDataController@getProvinsi')->name('getprovinsi.user');
    Route::post('/entry-operasi/cek-personil', 'InputDataController@cekPersonil')->name('cekPersonil.user');

    //Sarpas Unras pusat
    Route::get('/daftar-sarpas-unras/{param}', 'SarpasUnpasController@index');
    // Route::get('/daftar-sarpas-unras/detail/{id}', 'SarpasUnpasController@detailSarpasUnpas');
    Route::get('/daftar-sarpas-unras/detail/{id}', 'InputDataController@detail_operasi');
    Route::post('/daftar-sarpas-unras/filter/ops-intelejen', 'SarpasUnpasController@filterindexpusat');
    Route::post('/daftar-sarpas-unras/filter/ops-penegakan', 'SarpasUnpasController@filterindexpusat');
    Route::post('/daftar-sarpas-unras/filter/ops-pengamanan', 'SarpasUnpasController@filterindexpusat');
    Route::post('/daftar-sarpas-unras/filter/ops-pemeliharaan', 'SarpasUnpasController@filterindexpusat');
    Route::post('/daftar-sarpas-unras/filter/ops-pemulihan', 'SarpasUnpasController@filterindexpusat');

    //Sarpas Unras wilayah
    Route::get('/operasi-inteligen-wilayah/{param}', 'SarpasUnpasController@indexwilayah');
    // Route::get('/operasi-inteligen-wilayah/detail/{id}', 'SarpasUnpasController@detailSarpasUnpas');
    Route::get('/operasi-inteligen-wilayah/detail/{id}', 'InputDataController@detail_operasi');
    Route::post('/operasi-inteligen-wilayah/filter', 'SarpasUnpasController@filterindexwilayah');
    Route::post('/operasi-inteligen-wilayah/filter/ops-intelejen', 'SarpasUnpasController@filterindexwilayah');
    Route::post('/operasi-inteligen-wilayah/filter/ops-penegakan', 'SarpasUnpasController@filterindexwilayah');
    Route::post('/operasi-inteligen-wilayah/filter/ops-pengamanan', 'SarpasUnpasController@filterindexwilayah');
    Route::post('/operasi-inteligen-wilayah/filter/ops-pemeliharaan', 'SarpasUnpasController@filterindexwilayah');
    Route::post('/operasi-inteligen-wilayah/filter/ops-pemulihan', 'SarpasUnpasController@filterindexwilayah');


    //Entry Operasi
    Route::get('/entry-operasi', 'InputDataController@data_entry');

    Route::post('/store_data', 'InputDataController@store_data');
    Route::post('/update_data', 'InputDataController@update_data');

});
