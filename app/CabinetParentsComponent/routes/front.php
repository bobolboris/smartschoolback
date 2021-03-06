<?php

Route::post('/', 'CabinetParentsComponent\Http\Controllers\BaseController@baseAction');

Route::prefix('children')->group(function () {
    Route::post('index', 'CabinetParentsComponent\Http\Controllers\Children\IndexController@indexAction');
    Route::post('child', 'CabinetParentsComponent\Http\Controllers\Children\ChildController@childAction');
    Route::post('access-by-date', 'CabinetParentsComponent\Http\Controllers\Children\ChildController@getAccessByDateAction');
});

Route::prefix('notifications')->group(function () {
    Route::post('index', 'CabinetParentsComponent\Http\Controllers\NotificationsController@indexAction')->name('settings');
    Route::post('save', 'CabinetParentsComponent\Http\Controllers\NotificationsController@saveAction');
});

Route::prefix('settings')->group(function () {
    Route::post('index', 'CabinetParentsComponent\Http\Controllers\SettingsController@indexAction')->name('settings');
    Route::post('save', 'CabinetParentsComponent\Http\Controllers\SettingsController@saveAction');
});

Route::prefix('report')->group(function () {
    Route::post('child', 'CabinetParentsComponent\Http\Controllers\Children\ReportController@reportParentAction');
});

Route::prefix('key')->group(function () {
    Route::post('lock', 'CabinetParentsComponent\Http\Controllers\Children\KeysController@blockKeyAction');
    Route::post('unlock', 'CabinetParentsComponent\Http\Controllers\Children\KeysController@unblockKeyAction');
});

Route::prefix('additional-parents')->group(function () {
    Route::post('/', 'CabinetParentsComponent\Http\Controllers\AdditionalParentsController@additionalParentsIndexAction');
    Route::post('add', 'CabinetParentsComponent\Http\Controllers\AdditionalParentsController@addNewAdditionalParentAction');
    Route::post('edit', 'CabinetParentsComponent\Http\Controllers\AdditionalParentsController@additionalParentsEditAction');
    Route::post('edit_save', 'CabinetParentsComponent\Http\Controllers\AdditionalParentsController@saveAdditionalParentAction');
    Route::post('delete', 'CabinetParentsComponent\Http\Controllers\AdditionalParentsController@removeAdditionalParentAction');
});
