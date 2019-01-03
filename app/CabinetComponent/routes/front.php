<?php

Route::prefix('children')->group(function () {
    Route::post('index', 'CabinetComponent\Http\Controllers\ChildrenController@indexAction');
    Route::post('child', 'CabinetComponent\Http\Controllers\ChildrenController@childAction');
});

Route::prefix('settings')->group(function () {
    Route::post('index', 'CabinetComponent\Http\Controllers\SettingsController@indexAction')->name('settings');
    Route::post('save', 'CabinetComponent\Http\Controllers\SettingsController@saveAction');
});
