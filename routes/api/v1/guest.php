<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group( function ($router) {
    Route::post('login', 'AuthController@login')->name('auth.login');
});
