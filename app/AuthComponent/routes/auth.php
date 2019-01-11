<?php
Route::post('login', 'AuthComponent\Http\Controllers\AuthController@loginAction');
Route::post('code', 'AuthComponent\Http\Controllers\AuthController@codeAction');
Route::post('refresh', 'AuthComponent\Http\Controllers\AuthController@refreshAction');
