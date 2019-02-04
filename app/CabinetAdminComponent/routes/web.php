<?php

Route::prefix('admin')->group(function () {
    Route::get('/', 'CabinetAdminComponent\Http\Controllers\MainController@indexAction');

    Route::prefix('users')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAction')->name('admin.users');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\UsersController@usersSaveAction')->name('admin.users.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAddAction')->name('admin.users.add');
    });

    Route::prefix('parents')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAction')->name('admin.parents');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsSaveAction')->name('admin.parents.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAddAction')->name('admin.parents.add');
    });

    Route::prefix('schools')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAction')->name('admin.schools');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsSaveAction')->name('admin.schools.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAddAction')->name('admin.schools.add');
    });

    Route::prefix('classes')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAction')->name('admin.classes');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesSaveAction')->name('admin.classes.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAddAction')->name('admin.classes.add');
    });

    Route::prefix('children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAction')->name('admin.children');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenSaveAction')->name('admin.children.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAddAction')->name('admin.children.add');
    });

    Route::prefix('access_points')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAction')->name('admin.access_points');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsSaveAction')->name('admin.access_points.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAddAction')->name('admin.access_points.add');
    });



});
