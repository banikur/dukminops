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

    Route::namespace('master')->group(function(){
        //Master Provinsi
        Route::get('master/provinsi-dashboard','MasterProvinsiController@index');
        Route::post('master/provinsi-dashboard/tambah','MasterProvinsiController@tambah');
        Route::post('master/provinsi-dashboard/edit','MasterProvinsiController@edit');
        Route::get('master/provinsi-dashboard/hapus/{id}','MasterProvinsiController@hapus');

        //Master Pangkat
        Route::get('master/pangkat-dashboard','MasterPangkatController@index');
        Route::post('master/pangkat-dashboard/tambah','MasterPangkatController@tambah');
        Route::post('master/pangkat-dashboard/edit','MasterPangkatController@edit');
        Route::get('master/pangkat-dashboard/hapus/{id}','MasterPangkatController@hapus');

        //Master Jenis Peralatan
        Route::get('master/jenis-peralatan-dashboard','MasterJenisPeralatanController@index');
        Route::post('master/jenis-peralatan-dashboard/tambah','MasterJenisPeralatanController@tambah');
        Route::post('master/jenis-peralatan-dashboard/edit','MasterJenisPeralatanController@edit');
        Route::get('master/jenis-peralatan-dashboard/hapus/{id}','MasterJenisPeralatanController@hapus');
    });
    Route::get('/tambah-operasi-pusat', 'PegawaiController@add_operasi_index')->name('admin.add_operasi');
    Route::get('/list-operasi-all', 'EntryOperasiController@index')->name('admin.list-operasi');
    Route::get('/list-operasi-all/detail/{id}', 'PegawaiController@detail_operasi')->name('admin.detail_operasi');
    Route::get('/list-operasi-all/edit/{id}', 'PegawaiController@edit_operasi')->name('admin.edit_operasi');
    
    //user management
    Route::get('/user-management','UserManagementController@index');
    Route::get('/user-management/prov', 'UserManagementController@getProvinsi');

    Route::post('/pusat/store_data','PegawaiController@store_data');
    Route::post('/pusat/update_data','PegawaiController@update_data');
    Route::get('/pusat/entry-operasi/prov', 'PegawaiController@getProvinsi')->name('getprovinsi.user');

});

Route::name('user')->middleware('auth:user')->group(function () {
    Route::get('/dashboard-user', 'PegawaiController@index')->name('dashboard.user');
    Route::get('/tambah-operasi', 'PegawaiController@add_operasi_index')->name('add_operasi_index.user');
    Route::get('/entry-operasi/detail/{id}', 'PegawaiController@detail_operasi')->name('detail_operasi.user');
    Route::get('/entry-operasi/edit/{id}', 'PegawaiController@edit_operasi')->name('edit_operasi.user');
    Route::get('/entry-operasi/prov', 'PegawaiController@getProvinsi')->name('getprovinsi.user');
    
    //Sarpas Unras
    Route::get('/daftar-sarpas-unras','SarpasUnpasController@index');
    Route::get('/daftar-sarpas-unras/detail/{id}', 'SarpasUnpasController@detailSarpasUnpas');

    //Entry Operasi
    Route::get('/entry-operasi','EntryOperasiController@index');

    Route::post('/store_data','PegawaiController@store_data');
    Route::post('/update_data','PegawaiController@update_data');
 });