<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */



Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web', 'auth', 'role:admin']], function () {
    Route::group(['prefix' => 'guru'], function () {
        Route::get('/', 'GuruController@index')->name('guru.index');
        Route::get('/tambah', 'GuruController@create')->name('guru.create');
        Route::post('/', 'GuruController@store')->name('guru.store');
        Route::get('/{id}', 'GuruController@edit')->name('guru.edit');
        Route::put('/{id}', 'GuruController@update')->name('guru.update');
        Route::delete('/{id}', 'GuruController@destroy')->name('guru.destroy');
    });
    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/', 'KelasController@index')->name('kelas.index');
        Route::get('/tambah', 'KelasController@create')->name('kelas.create');
        Route::post('/', 'KelasController@store')->name('kelas.store');
        Route::get('/{id}', 'KelasController@edit')->name('kelas.edit');
        Route::put('/{id}', 'KelasController@update')->name('kelas.update');
        Route::delete('/{id}', 'KelasController@destroy')->name('kelas.destroy');
    });
    Route::group(['prefix' => 'mapel'], function () {
        Route::get('/', 'MapelController@index')->name('mapel.index');
        Route::get('/tambah', 'MapelController@create')->name('mapel.create');
        Route::post('/', 'MapelController@store')->name('mapel.store');
        Route::get('/{id}', 'MapelController@edit')->name('mapel.edit');
        Route::put('/{id}', 'MapelController@update')->name('mapel.update');
        Route::delete('/{id}', 'MapelController@destroy')->name('mapel.destroy');
    });
    Route::group(['prefix' => 'siswa'], function () {
        Route::get('/', 'SiswaController@index')->name('siswa.index');
        Route::get('/tambah', 'SiswaController@create')->name('siswa.create');
        Route::post('/', 'SiswaController@store')->name('siswa.store');
        Route::get('/{id}', 'SiswaController@edit')->name('siswa.edit');
        Route::put('/{id}', 'SiswaController@update')->name('siswa.update');
        Route::delete('/{id}', 'SiswaController@destroy')->name('siswa.destroy');
    });
});

Route::group(['middleware' => ['web', 'auth', 'role:guru']], function () {
    Route::group(['prefix' => 'absen'], function () {
        Route::get('/', 'KehadiranController@index')->name('kehadiran.index');
        Route::get('/siswa', 'KehadiranController@siswa')->name('absenSiswaPerKelas');
        Route::post('/', 'KehadiranController@store')->name('kehadiran.store');
    });
    Route::group(['prefix' => 'nilai'], function () {
        Route::get('/', 'NilaiController@index')->name('nilai.index');
        Route::get('/siswa', 'NilaiController@siswa')->name('nilaiSiswaPerKelas');
        Route::get('/siswa/kelas', 'NilaiController@mapel')->name('mapel');
        Route::get('/{id}', 'NilaiController@edit')->name('nilai.edit');
        Route::put('/{id}', 'NilaiController@update')->name('nilai.update');
        Route::post('/', 'NilaiController@store')->name('nilai.store');
    });
});

