<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return 'web';});

Route::get('/impetus-table', function () {return view('table');})->name('impetus.table');
