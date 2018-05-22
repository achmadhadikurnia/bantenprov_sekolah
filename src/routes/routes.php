<?php

Route::group(['prefix' => 'api/jenis-sekolah', 'middleware' => ['auth', 'role:superadministrator']], function() {
    $class          = 'Bantenprov\Sekolah\Http\Controllers\JenisSekolahController';
    $name           = 'jenis-sekolah';
    $controllers    = (object) [
        'index'     => $class.'@index',
        'get'       => $class.'@get',
        'create'    => $class.'@create',
        'show'      => $class.'@show',
        'store'     => $class.'@store',
        'edit'      => $class.'@edit',
        'update'    => $class.'@update',
        'destroy'   => $class.'@destroy',
    ];

    Route::get('/',             $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',          $controllers->get)->name($name.'.get')->middleware(['role:superadministrator']);
    Route::get('/create',       $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::post('/',            $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}',         $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',         $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/sekolah', 'middleware' => ['auth', 'role:superadministrator|admin_sekolah']], function() {
    $class          = 'Bantenprov\Sekolah\Http\Controllers\SekolahController';
    $name           = 'sekolah';
    $controllers    = (object) [
        'index'     => $class.'@index',
        'get'       => $class.'@get',
        'create'    => $class.'@create',
        'show'      => $class.'@show',
        'store'     => $class.'@store',
        'edit'      => $class.'@edit',
        'update'    => $class.'@update',
        'destroy'   => $class.'@destroy',
    ];

    Route::get('/',             $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',          $controllers->get)->name($name.'.get')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',       $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::post('/',            $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}',         $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',         $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/prodi-sekolah', 'middleware' => ['auth', 'role:superadministrator']], function() {
    $class          = 'Bantenprov\Sekolah\Http\Controllers\ProdiSekolahController';
    $name           = 'prodi-sekolah';
    $controllers    = (object) [
        'index'         => $class.'@index',
        'get'           => $class.'@get',
        'getBySekolah'  => $class.'@getBySekolah',
        'create'        => $class.'@create',
        'show'          => $class.'@show',
        'store'         => $class.'@store',
        'edit'          => $class.'@edit',
        'update'        => $class.'@update',
        'destroy'       => $class.'@destroy',
    ];

    Route::get('/',                     $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',                  $controllers->get)->name($name.'.get')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/get/by-sekolah/{id}',  $controllers->getBySekolah)->name($name.'.get-by-sekolah')->middleware(['role:superadministrator|admin_sekolah']);
    Route::get('/create',               $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::post('/',                    $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}',                 $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',            $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',                 $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',              $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});

Route::group(['prefix' => 'api/admin-sekolah', 'middleware' => ['auth', 'role:superadministrator']], function() {
    $class          = 'Bantenprov\Sekolah\Http\Controllers\AdminSekolahController';
    $name           = 'admin-sekolah';
    $controllers    = (object) [
        'index'         => $class.'@index',
        'get'           => $class.'@get',
        'create'        => $class.'@create',
        'show'          => $class.'@show',
        'store'         => $class.'@store',
        'edit'          => $class.'@edit',
        'update'        => $class.'@update',
        'destroy'       => $class.'@destroy',
    ];

    Route::get('/',             $controllers->index)->name($name.'.index')->middleware(['role:superadministrator']);
    Route::get('/get',          $controllers->get)->name($name.'.get')->middleware(['role:superadministrator']);
    Route::get('/create',       $controllers->create)->name($name.'.create')->middleware(['role:superadministrator']);
    Route::post('/',            $controllers->store)->name($name.'.store')->middleware(['role:superadministrator']);
    Route::get('/{id}',         $controllers->show)->name($name.'.show')->middleware(['role:superadministrator']);
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit')->middleware(['role:superadministrator']);
    Route::put('/{id}',         $controllers->update)->name($name.'.update')->middleware(['role:superadministrator']);
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy')->middleware(['role:superadministrator']);
});
