<?php

Route::prefix('admin')->group(function () {

    Route::match(['get', 'head'], 'login', 'CabinetAdminComponent\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'CabinetAdminComponent\Http\Controllers\Auth\LoginController@login');
    Route::get('logout', 'CabinetAdminComponent\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::post('logout', 'CabinetAdminComponent\Http\Controllers\Auth\LoginController@logout');

    Route::prefix('email')->group(function () {
        Route::match(['get', 'head'], 'resend', 'CabinetAdminComponent\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend')->middleware('auth', 'throttle:6,1');;
        Route::match(['get', 'head'], 'verify', 'CabinetAdminComponent\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
        Route::match(['get', 'head'], 'verify/{id}', 'CabinetAdminComponent\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify')->middleware('auth', 'signed', 'throttle:6,1');
    });

    Route::prefix('password')->group(function () {
        Route::post('email', 'CabinetAdminComponent\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::match(['get', 'head'], 'reset', 'CabinetAdminComponent\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('reset', 'CabinetAdminComponent\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
        Route::match(['get', 'head'], 'reset/{token}', 'CabinetAdminComponent\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    });

    Route::match(['get', 'head'], 'register', 'CabinetAdminComponent\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'CabinetAdminComponent\Http\Controllers\Auth\RegisterController@register');

    Route::get('/', 'CabinetAdminComponent\Http\Controllers\MainController@indexAction')->name('cabinet.admin.index');

    Route::prefix('users')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAction')->name('admin.users');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showEditFormAction')->name('admin.users.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showAddFormAction')->name('admin.users.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showRemoveFormAction')->name('admin.users.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\UsersController@usersSaveAction')->name('admin.users.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\UsersController@usersAddAction')->name('admin.users.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\UsersController@usersRemoveAction')->name('admin.users.remove');
    });

    Route::prefix('parents')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAction')->name('admin.parents');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showEditFormAction')->name('admin.parents.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showAddFormAction')->name('admin.parents.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showRemoveFormAction')->name('admin.parents.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsSaveAction')->name('admin.parents.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ParentsController@parentsAddAction')->name('admin.parents.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ParentsController@childrenRemoveAction')->name('admin.parents.remove');

    });

    Route::prefix('schools')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAction')->name('admin.schools');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showEditFormAction')->name('admin.schools.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showAddFormAction')->name('admin.schools.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showRemoveFormAction')->name('admin.schools.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsSaveAction')->name('admin.schools.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsAddAction')->name('admin.schools.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\SchoolsController@schoolsRemoveAction')->name('admin.schools.remove');

    });

    Route::prefix('classes')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAction')->name('admin.classes');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showEditFormAction')->name('admin.classes.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showAddFormAction')->name('admin.classes.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showRemoveFormAction')->name('admin.classes.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesSaveAction')->name('admin.classes.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ClassesController@classesAddAction')->name('admin.classes.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ClassesController@childrenRemoveAction')->name('admin.classes.remove');
    });

    Route::prefix('children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAction')->name('admin.children');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showEditFormAction')->name('admin.children.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showAddFormAction')->name('admin.children.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showRemoveFormAction')->name('admin.children.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenSaveAction')->name('admin.children.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenAddAction')->name('admin.children.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenController@childrenRemoveAction')->name('admin.children.remove');
    });

    Route::prefix('children_extended')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@childrenAction')->name('admin.children_extended');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showEditFormAction')->name('admin.children_extended.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showAddFormAction')->name('admin.children_extended.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showRemoveFormAction')->name('admin.children_extended.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@childrenSaveAction')->name('admin.children_extended.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@childrenAddAction')->name('admin.children_extended.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@childrenRemoveAction')->name('admin.children_extended.remove');
    });

    Route::prefix('access_points')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAction')->name('admin.access_points');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showEditFormAction')->name('admin.access_points.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showAddFormAction')->name('admin.access_points.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showRemoveFormAction')->name('admin.access_points.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsSaveAction')->name('admin.access_points.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointsAddAction')->name('admin.access_points.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@accessPointRemoveAction')->name('admin.access_points.remove');
    });

    Route::prefix('parent_children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildParentController@parentChildrenAction')->name('admin.parent_children');
        Route::get('removeForm', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showRemoveFormAction')->name('admin.parent_children.removeForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showAddChildFormAction')->name('admin.parent_children.addChildForm');

        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildParentController@parentChildrenRemoveAction')->name('admin.parent_children.remove');
        Route::post('add_child', 'CabinetAdminComponent\Http\Controllers\ChildParentController@addChildAction')->name('admin.parent_children.addChild');

    });

});
