<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->file(resource_path('views/home-infosewa.html'));
});

Route::get('/pesan', function () {
    return response()->file(resource_path('views/pesan-infosewa.html'));
});
