<?php

Route::prefix('admin')->group(function () {
    Route::get('/', 'CabinetAdminComponent\Http\Controllers\MainController@indexAction');

    Route::prefix('users')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAction')->name('admin.users');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\UsersController@showEditFormAction')->name('admin.users.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\UsersController@showAddFormAction')->name('admin.users.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\UsersController@showRemoveFormAction')->name('admin.users.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\UsersController@usersSaveAction')->name('admin.users.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAddAction')->name('admin.users.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\UsersController@usersRemoveAction')->name('admin.users.remove');
    });

    Route::prefix('parents')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAction')->name('admin.parents');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\ParentsController@showEditFormAction')->name('admin.parents.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\ParentsController@showAddFormAction')->name('admin.parents.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\ParentsController@showRemoveFormAction')->name('admin.parents.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsSaveAction')->name('admin.parents.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAddAction')->name('admin.parents.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ParentsController@childrenRemoveAction')->name('admin.parents.remove');

    });

    Route::prefix('schools')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAction')->name('admin.schools');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showEditFormAction')->name('admin.schools.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showAddFormAction')->name('admin.schools.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showRemoveFormAction')->name('admin.schools.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsSaveAction')->name('admin.schools.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAddAction')->name('admin.schools.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsRemoveAction')->name('admin.schools.remove');

    });

    Route::prefix('classes')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAction')->name('admin.classes');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\ClassesController@showEditFormAction')->name('admin.classes.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\ClassesController@showAddFormAction')->name('admin.classes.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\ClassesController@showRemoveFormAction')->name('admin.classes.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesSaveAction')->name('admin.classes.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAddAction')->name('admin.classes.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ClassesController@childrenRemoveAction')->name('admin.classes.remove');
    });

    Route::prefix('children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAction')->name('admin.children');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showEditFormAction')->name('admin.children.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showAddFormAction')->name('admin.children.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showRemoveFormAction')->name('admin.children.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenSaveAction')->name('admin.children.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAddAction')->name('admin.children.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenRemoveAction')->name('admin.children.remove');
    });

    Route::prefix('access_points')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAction')->name('admin.access_points');
        Route::get('editForm', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showEditFormAction')->name('admin.access_points.editForm');
        Route::get('addForm', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showAddFormAction')->name('admin.access_points.addForm');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showRemoveFormAction')->name('admin.access_points.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsSaveAction')->name('admin.access_points.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAddAction')->name('admin.access_points.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointRemoveAction')->name('admin.access_points.remove');
    });

    Route::prefix('parent_children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildParentController@parentChildrenAction')->name('admin.parent_children');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showRemoveFormAction')->name('admin.parent_children.editForm');
        Route::get('addChildForm', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showAddChildFormAction')->name('admin.parent_children.addChildForm');

        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildParentController@parentChildrenRemoveAction')->name('admin.parent_children.remove');
        Route::post('addChild', 'CabinetAdminComponent\Http\Controllers\ChildParentController@addChildAction')->name('admin.parent_children.addChild');

    });

});
