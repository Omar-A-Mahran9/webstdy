<?php

 use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/product',[ProductController::class,'store']);
Route::get('/product',[ProductController::class,'index']);
Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);
Route::post('/product/update/{id}',[ProductController::class,'update']);

Route::get('/product/{id}',[ProductController::class,'showproduct']);
Route::get('/filter/{id}',[ProductController::class,'filter']);


Route::post('/option',[OptionController::class,'store']);
Route::get('/option',[OptionController::class,'index']);
Route::delete('/option/delete/{id}',[OptionController::class,'destroy']);

Route::get('/',[HomeController::class,'index']);




Route::get('admin/{any}',ApplicationController::class)->where('admin','(.*)')->middleware('auth');