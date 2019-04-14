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
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\UsersController@indexAction')->name('admin.users');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showEditFormAction')->name('admin.users.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showAddFormAction')->name('admin.users.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\UsersController@showRemoveFormAction')->name('admin.users.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\UsersController@saveAction')->name('admin.users.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\UsersController@addAction')->name('admin.users.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\UsersController@removeAction')->name('admin.users.remove');
    });

    Route::prefix('parents')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ParentsController@indexAction')->name('admin.parents');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showEditFormAction')->name('admin.parents.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showAddFormAction')->name('admin.parents.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ParentsController@showRemoveFormAction')->name('admin.parents.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ParentsController@saveAction')->name('admin.parents.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ParentsController@addAction')->name('admin.parents.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ParentsController@removeAction')->name('admin.parents.remove');

    });

    Route::prefix('schools')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\SchoolsController@indexAction')->name('admin.schools');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showEditFormAction')->name('admin.schools.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showAddFormAction')->name('admin.schools.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\SchoolsController@showRemoveFormAction')->name('admin.schools.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\SchoolsController@saveAction')->name('admin.schools.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\SchoolsController@addAction')->name('admin.schools.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\SchoolsController@removeAction')->name('admin.schools.remove');

    });

    Route::prefix('classes')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ClassesController@indexAction')->name('admin.classes');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showEditFormAction')->name('admin.classes.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showAddFormAction')->name('admin.classes.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ClassesController@showRemoveFormAction')->name('admin.classes.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ClassesController@saveAction')->name('admin.classes.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ClassesController@addAction')->name('admin.classes.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ClassesController@removeAction')->name('admin.classes.remove');
    });

    Route::prefix('children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenController@indexAction')->name('admin.children');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showEditFormAction')->name('admin.children.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showAddFormAction')->name('admin.children.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildrenController@showRemoveFormAction')->name('admin.children.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenController@saveAction')->name('admin.children.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenController@addAction')->name('admin.children.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenController@removeAction')->name('admin.children.remove');
    });

    Route::prefix('children_extended')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@indexAction')->name('admin.children_extended');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showEditFormAction')->name('admin.children_extended.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showAddFormAction')->name('admin.children_extended.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@showRemoveFormAction')->name('admin.children_extended.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@saveAction')->name('admin.children_extended.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@addAction')->name('admin.children_extended.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenExtendedController@removeAction')->name('admin.children_extended.remove');
    });

    Route::prefix('access_points')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@indexAction')->name('admin.access_points');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showEditFormAction')->name('admin.access_points.editForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showAddFormAction')->name('admin.access_points.addForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@showRemoveFormAction')->name('admin.access_points.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@saveAction')->name('admin.access_points.save');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@addAction')->name('admin.access_points.add');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AccessPointsController@removeAction')->name('admin.access_points.remove');
    });

    Route::prefix('parent_children')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildParentController@indexAction')->name('admin.parent_children');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showRemoveFormAction')->name('admin.parent_children.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildParentController@showAddFormAction')->name('admin.parent_children.addChildForm');

        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildParentController@removeAction')->name('admin.parent_children.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildParentController@addAction')->name('admin.parent_children.add');

    });

    Route::prefix('profiles')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ProfilesController@indexAction')->name('admin.profiles');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ProfilesController@showRemoveFormAction')->name('admin.profiles.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ProfilesController@showAddFormAction')->name('admin.profiles.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ProfilesController@showEditFormAction')->name('admin.profiles.editForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ProfilesController@saveAction')->name('admin.profile.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ProfilesController@removeAction')->name('admin.profile.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ProfilesController@addAction')->name('admin.profile.add');

    });

    Route::prefix('admins_extended')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@indexAction')->name('admin.admins_extended');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@showRemoveFormAction')->name('admin.admins_extended.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@showAddFormAction')->name('admin.admins_extended.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@showEditFormAction')->name('admin.admins_extended.editForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@saveAction')->name('admin.admins_extended.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@removeAction')->name('admin.admins_extended.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AdminsExtendedController@addAction')->name('admin.admins_extended.add');
    });

    Route::prefix('localities')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@indexAction')->name('admin.localities');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@showRemoveFormAction')->name('admin.localities.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@showAddFormAction')->name('admin.localities.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@showEditFormAction')->name('admin.localities.editForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@saveAction')->name('admin.localities.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@removeAction')->name('admin.localities.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\LocalitiesController@addAction')->name('admin.localities.add');
    });

    Route::prefix('children_keys')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@indexAction')->name('admin.children_keys');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@showRemoveFormAction')->name('admin.children_keys.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@showAddFormAction')->name('admin.children_keys.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@showEditFormAction')->name('admin.children_keys.editForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@saveAction')->name('admin.children_keys.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@removeAction')->name('admin.children_keys.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\ChildrenKeysController@addAction')->name('admin.children_keys.add');
    });

    Route::prefix('admins')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AdminsController@indexAction')->name('admin.admins');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\AdminsController@showRemoveFormAction')->name('admin.admins.removeForm');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\AdminsController@showAddFormAction')->name('admin.admins.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\AdminsController@showEditFormAction')->name('admin.admins.editForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AdminsController@saveAction')->name('admin.admins.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AdminsController@removeAction')->name('admin.admins.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AdminsController@addAction')->name('admin.admins.add');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\SettingsController@indexAction')->name('admin.settings');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\SettingsController@showRemoveFormAction')->name('admin.settings.removeForm');

        Route::post('add', 'CabinetAdminComponent\Http\Controllers\SettingsController@addAction')->name('admin.settings.add');
        Route::get('remove', 'CabinetAdminComponent\Http\Controllers\SettingsController@removeAction');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\SettingsController@removeAction')->name('admin.settings.remove');
        Route::post('save', 'CabinetAdminComponent\Http\Controllers\SettingsController@saveAction')->name('admin.settings.save');
    });

    Route::prefix('accesses')->group(function () {
        Route::get('/', 'CabinetAdminComponent\Http\Controllers\AccessesController@indexAction')->name('admin.accesses');
        Route::get('add_form', 'CabinetAdminComponent\Http\Controllers\AccessesController@showAddFormAction')->name('admin.accesses.addForm');
        Route::get('edit_form', 'CabinetAdminComponent\Http\Controllers\AccessesController@showEditFormAction')->name('admin.accesses.editForm');
        Route::get('remove_form', 'CabinetAdminComponent\Http\Controllers\AccessesController@showRemoveFormAction')->name('admin.accesses.removeForm');

        Route::post('save', 'CabinetAdminComponent\Http\Controllers\AccessesController@saveAction')->name('admin.accesses.save');
        Route::post('remove', 'CabinetAdminComponent\Http\Controllers\AccessesController@removeAction')->name('admin.accesses.remove');
        Route::post('add', 'CabinetAdminComponent\Http\Controllers\AccessesController@addAction')->name('admin.accesses.add');
    });
});
