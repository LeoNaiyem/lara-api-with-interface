<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.doctors.index');
});
Route::get('/patients', function () {
    return view('pages.patients.index');
});
