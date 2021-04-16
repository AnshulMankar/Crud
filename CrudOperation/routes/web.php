<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
Route::post("getstate",[ProductController::class,'getstateinfo']);
Route::post("getcity",[ProductController::class,"getcityinfo"]);
