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
    Route::get('/employee-dashboard', 'HrdController@data_pegawai')->name('employee.hrd');
    Route::get('/absence-dashboard', 'HrdController@data_absence')->name('data_absence.hrd');
    Route::get('/divisi-dashboard', 'HrdController@divisi_view')->name('employee.divisi');
    Route::get('/tunjangan-dashboard', 'HrdController@tunjangan_view')->name('employee.tunjangan');
    Route::get('/payroll-dashboard', 'HrdController@payroll_view')->name('employee.payroll');
    Route::get('/penilaian-dashboard', 'HrdController@penilaian_view')->name('employee.penilaian_view');
    Route::get('/penilaian-pegawai-dashboard', 'HrdController@penilaian_pegawai_view')->name('employee.penilaian_pegawai_view');

    Route::get('/get_data_emp/{id}', 'HrdController@get_data_emp')->name('get_data_emp.hrd');
    Route::get('/get_data_divisi/{id}', 'HrdController@get_data_divisi')->name('get_data_divisi.hrd');
    Route::get('/get_data_payroll/{id}', 'HrdController@get_data_payroll')->name('get_data_payroll.hrd');
    Route::get('/get_data_penilaian/{id}', 'HrdController@get_data_penilaian')->name('get_data_penilaian.hrd');
    Route::get('/get_data_user_penilaian/{id}', 'HrdController@get_data_user_penilaian')->name('get_data_user_penilaian.hrd');
    Route::get('/get_data_penilaian_pegawai/{id}', 'HrdController@get_data_penilaian_pegawai')->name('get_data_penilaian_pegawai.hrd');
    Route::get('/get_data_tunjangan/{id}', 'HrdController@get_data_tunjangan')->name('get_data_tunjangan.hrd');
    
    route::post('/store_employee', 'HrdController@store_employee')->name('store_employee.hrd');
    route::post('/update_employee', 'HrdController@update_employee')->name('update_employee.hrd');

    route::post('/update_upah', 'HrdController@update_upah')->name('update_upah.hrd');
    route::post('/store_upah', 'HrdController@store_upah')->name('store_upah.hrd');

    route::post('/update_divisi', 'HrdController@update_divisi')->name('update_divisi.hrd');
    route::post('/store_divisi', 'HrdController@store_divisi')->name('store_divisi.hrd');

    route::post('/update_tunjangan', 'HrdController@update_tunjangan')->name('update_tunjangan.hrd');
    route::post('/store_tunjangan', 'HrdController@store_tunjangan')->name('store_tunjangan.hrd');

    route::post('/update_penilaian', 'HrdController@update_penilaian')->name('update_penilaian.hrd');
    route::post('/store_penilaian', 'HrdController@store_penilaian')->name('store_penilaian.hrd');

    route::post('/update_nilai_pegawai', 'HrdController@update_nilai_pegawai')->name('update_nilai_pegawai.hrd');
    route::post('/store_nilai_pegawai', 'HrdController@store_nilai_pegawai')->name('store_nilai_pegawai.hrd');
    Route::get('/cetak_slip/{id}', 'HrdController@cetak_slip')->name('cetak_slip');

});

Route::name('user')->middleware('auth:user')->group(function () {
    Route::get('/dashboard-user', 'PegawaiController@index')->name('dashboard.user');
    Route::get('/nilai-user', 'PegawaiController@index_nilai')->name('index_nilai.user');

 });

Route::name('perusahaan')->middleware('auth:perusahaan')->group(function () { });

/*AHMAD ZAKKY*/
