<?php

Route::group(['prefix' => 'api/jenis-sekolah', 'middleware' => ['web','role:superministrator']], function() {
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

    Route::get('/',             $controllers->index)->name($name.'.index');
    Route::get('/get',          $controllers->get)->name($name.'.get');
    Route::get('/create',       $controllers->create)->name($name.'.create');
    Route::get('/{id}',         $controllers->show)->name($name.'.show');
    Route::post('/',            $controllers->store)->name($name.'.store');
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit');
    Route::put('/{id}',         $controllers->update)->name($name.'.update');
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy');
});

Route::group(['prefix' => 'api/sekolah', 'middleware' => ['web','role:superministrator']], function() {
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

    Route::get('/',             $controllers->index)->name($name.'.index');
    Route::get('/get',          $controllers->get)->name($name.'.get');
    Route::get('/create',       $controllers->create)->name($name.'.create');
    Route::get('/{id}',         $controllers->show)->name($name.'.show');
    Route::post('/',            $controllers->store)->name($name.'.store');
    Route::get('/{id}/edit',    $controllers->edit)->name($name.'.edit');
    Route::put('/{id}',         $controllers->update)->name($name.'.update');
    Route::delete('/{id}',      $controllers->destroy)->name($name.'.destroy');
});

Route::group(['prefix' => 'api/prodi-sekolah', 'middleware' => ['web','role:superministrator']], function() {
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

    Route::get('/',                     $controllers->index)->name($name.'.index');
    Route::get('/get',                  $controllers->get)->name($name.'.get');
    Route::get('/get/by-sekolah/{id}',  $controllers->getBySekolah)->name($name.'.get-by-sekolah');
    Route::get('/create',               $controllers->create)->name($name.'.create');
    Route::get('/{id}',                 $controllers->show)->name($name.'.show');
    Route::post('/',                    $controllers->store)->name($name.'.store');
    Route::get('/{id}/edit',            $controllers->edit)->name($name.'.edit');
    Route::put('/{id}',                 $controllers->update)->name($name.'.update');
    Route::delete('/{id}',              $controllers->destroy)->name($name.'.destroy');
});

Route::group(['prefix' => 'api/admin-sekolah', 'middleware' => ['web']], function() {
    $class          = 'Bantenprov\Sekolah\Http\Controllers\AdminSekolahController';
    $name           = 'admin-sekolah';
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

    Route::get('/',                     $controllers->index)->name($name.'.index')->middleware('role:administrator|admin_sekolah');
    Route::get('/get',                  $controllers->get)->name($name.'.get')->middleware('role:administrator|admin_sekolah');
    Route::get('/get/by-sekolah/{id}',  $controllers->getBySekolah)->name($name.'.get-by-sekolah')->middleware('role:administrator|admin_sekolah');
    Route::get('/create',               $controllers->create)->name($name.'.create')->middleware('role:superministrator');
    Route::get('/{id}',                 $controllers->show)->name($name.'.show')->middleware('role:superministrator');
    Route::post('/',                    $controllers->store)->name($name.'.store')->middleware('role:superministrator');
    Route::get('/{id}/edit',            $controllers->edit)->name($name.'.edit')->middleware('role:superministrator');
    Route::put('/{id}',                 $controllers->update)->name($name.'.update')->middleware('role:superministrator');
    Route::delete('/{id}',              $controllers->destroy)->name($name.'.destroy')->middleware('role:superministrator');
});