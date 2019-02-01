<?php

Route::prefix('admin')->group(function () {
    Route::get('/', 'CabinetAdminComponent\Http\Controllers\MainController@indexAction');
    Route::get('users', 'CabinetAdminComponent\Http\Controllers\MainController@usersAction')->name('admin.users');

    Route::prefix('parents')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAction')->name('admin.parents');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsSaveAction')->name('admin.parents.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAddAction')->name('admin.parents.add');
    });

    Route::get('schools', 'CabinetAdminComponent\Http\Controllers\MainController@parentsAction')->name('admin.schools');

    Route::prefix('children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAction')->name('admin.children');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenSaveAction')->name('admin.children.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAddAction')->name('admin.children.add');
    });


    Route::get('access_points', 'CabinetAdminComponent\Http\Controllers\MainController@accessPointsAction')->name('admin.access_points');
});
