<?php

Route::prefix('children')->group(function () {
    Route::post('index', 'CabinetComponent\Http\Controllers\Children\IndexController@indexAction');
    Route::post('child', 'CabinetComponent\Http\Controllers\Children\ChildController@childAction');
    Route::post('access-by-date', 'CabinetComponent\Http\Controllers\Children\ChildController@getAccessByDateAction');
});

Route::prefix('settings')->group(function () {
    Route::post('index', 'CabinetComponent\Http\Controllers\SettingsController@indexAction')->name('settings');
    Route::post('save', 'CabinetComponent\Http\Controllers\SettingsController@saveAction');
});

Route::prefix('report')->group(function () {
    Route::post('child', 'CabinetComponent\Http\Controllers\Children\ReportController@reportParentAction');
});

Route::prefix('key')->group(function () {
    Route::post('lock', 'CabinetComponent\Http\Controllers\Children\KeysController@blockKeyAction');
    Route::post('unlock', 'CabinetComponent\Http\Controllers\Children\KeysController@unblockKeyAction');
});

