<?php

use App\Http\Controllers\Admin\PesertaController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Agenda
    Route::delete('agendas/destroy', 'AgendaController@massDestroy')->name('agendas.massDestroy');
    Route::post('agendas/parse-csv-import', 'AgendaController@parseCsvImport')->name('agendas.parseCsvImport');
    Route::post('agendas/process-csv-import', 'AgendaController@processCsvImport')->name('agendas.processCsvImport');
    Route::resource('agendas', 'AgendaController');

    // Session
    Route::delete('sessions/destroy', 'SessionController@massDestroy')->name('sessions.massDestroy');
    Route::post('sessions/parse-csv-import', 'SessionController@parseCsvImport')->name('sessions.parseCsvImport');
    Route::post('sessions/process-csv-import', 'SessionController@processCsvImport')->name('sessions.processCsvImport');
    Route::resource('sessions', 'SessionController');

    // Peserta
    Route::delete('peserta/destroy', 'PesertaController@massDestroy')->name('peserta.massDestroy');
    Route::post('peserta/media', 'PesertaController@storeMedia')->name('peserta.storeMedia');
    Route::post('peserta/ckmedia', 'PesertaController@storeCKEditorImages')->name('peserta.storeCKEditorImages');
    Route::post('peserta/parse-csv-import', 'PesertaController@parseCsvImport')->name('peserta.parseCsvImport');
    Route::post('peserta/process-csv-import', 'PesertaController@processCsvImport')->name('peserta.processCsvImport');
    Route::get('peserta/{pesertum}/generate/{id}', [PesertaController::class, 'generate'])->name('peserta.generate');
    Route::resource('peserta', 'PesertaController');

    // Presensi
    Route::delete('presensis/destroy', 'PresensiController@massDestroy')->name('presensis.massDestroy');
    Route::post('presensis/parse-csv-import', 'PresensiController@parseCsvImport')->name('presensis.parseCsvImport');
    Route::post('presensis/process-csv-import', 'PresensiController@processCsvImport')->name('presensis.processCsvImport');
    Route::resource('presensis', 'PresensiController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Presensi Makan
    Route::delete('presensi-makans/destroy', 'PresensiMakanController@massDestroy')->name('presensi-makans.massDestroy');
    Route::resource('presensi-makans', 'PresensiMakanController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
