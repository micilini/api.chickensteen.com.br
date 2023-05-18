<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* ROUTES FOR USER */
Route::post('/users/signup', [App\Http\Controllers\Api\UserController::class, 'signup']);
Route::post('/users/login', [App\Http\Controllers\Api\UserController::class, 'login']);

/* ROUTES FOR BOOKING */
Route::post('/book/getHours', [App\Http\Controllers\Api\BookController::class, 'getHours']);
Route::post('/book/new', [App\Http\Controllers\Api\BookController::class, 'newBook']);

/* ROUTES FOR CONTACT */
Route::post('/contact/new', [App\Http\Controllers\Api\ContactController::class, 'newContact']);


/* DEFAULT ROUTE */
Route::get('/', function(){
    return response()->json([
        'success' => true
    ]);
});
