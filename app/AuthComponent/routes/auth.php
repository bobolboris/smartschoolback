<?php
Route::prefix('login')->group(function () {
    Route::post('first-stage', 'AuthComponent\Http\Controllers\AuthController@loginFirstStageAction');
    Route::post('second-stage', 'AuthComponent\Http\Controllers\AuthController@loginSecondStageAction');
});

Route::prefix('token')->group(function () {
    Route::post('refresh', 'AuthComponent\Http\Controllers\AuthController@refreshTokenAction');
});

Route::post('logout', 'AuthComponent\Http\Controllers\AuthController@logoutAction')->middleware('jwt.verify');

Route::prefix('sms-code')->group(function () {
    Route::post('refresh', 'AuthComponent\Http\Controllers\AuthController@refreshSmsCodeAction');
});


