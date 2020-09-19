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

Route::get('/absence-input/{data}/{date}', 'VerifiedController@postdata')->name('logout');

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
    });
    
});

Route::name('user')->middleware('auth:user')->group(function () {
    Route::get('/dashboard-user', 'PegawaiController@index')->name('dashboard.user');
    Route::get('/tambah-operasi', 'PegawaiController@add_operasi_index')->name('add_operasi_index.user');

 });