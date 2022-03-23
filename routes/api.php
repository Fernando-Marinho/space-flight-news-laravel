<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


Route::get('/', function () {
    return response()->json('Back-end Challenge 2021 🏅 - Space Flight News', 200);
});

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles/', 'index');
    Route::get('/articles/{id}', 'show');
    Route::post('/articles/', 'store');
    Route::put('/articles/{id}', 'update');
    Route::delete('/articles/{id}', 'destroy');
});
