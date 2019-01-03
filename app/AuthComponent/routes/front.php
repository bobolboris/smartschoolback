<?php
Route::post('login', 'AuthComponent\Http\Controllers\LoginController@loginAction');
Route::post('code', 'AuthComponent\Http\Controllers\LoginController@codeAction');
Route::post('test', 'AuthComponent\Http\Controllers\LoginController@testAction');
