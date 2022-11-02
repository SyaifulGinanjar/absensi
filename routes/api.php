<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresensiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Agenda
    Route::apiResource('agendas', 'AgendaApiController');

    // Session
    Route::apiResource('sessions', 'SessionApiController');

    // Peserta
    Route::post('peserta/media', 'PesertaApiController@storeMedia')->name('peserta.storeMedia');
    Route::apiResource('peserta', 'PesertaApiController');

    // Presensi
    Route::apiResource('presensis', 'PresensiApiController', ['except' => ['store', 'update']]);

    // Presensi Makan
    Route::apiResource('presensi-makans', 'PresensiMakanApiController');
});


Route::get('/userdata/{uuid}', [HomeController::class, 'userData'])->name('userData');
Route::post('/presensi', [PresensiController::class, 'store'])->name('storePresensi');
Route::get('/presensi', [PresensiController::class, 'getPresensi'])->name('getPresensi');
Route::get('/session', [PresensiController::class, 'getCurrentSession'])->name('getCurrentSession');
Route::post('/presensi-makan', [PresensiController::class, 'storeMakan'])->name('storeMakanPresensi');
Route::post('/auth/login', 'HomeController@login')->name('auth.login');
