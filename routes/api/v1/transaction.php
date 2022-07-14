<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('transaction', 'TransactionController')->except(['update']);
