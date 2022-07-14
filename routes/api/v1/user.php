<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ($router) {
    Route::get('logout', 'AuthController@logout')->name('auth.logout');
    Route::get('refresh', 'AuthController@refresh')->name('auth.refresh');
    Route::get('me', 'AuthController@me')->name('auth.me');
});
