<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('transfer', 'TransferController')->except(['update']);
