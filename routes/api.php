<?php

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
});
