<?php

Route::prefix('admin')->group(function () {
    Route::get('/', 'CabinetAdminComponent\Http\Controllers\MainController@indexAction');
});
