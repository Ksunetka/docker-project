<?php

use App\Http\Controllers\PhoneBook\UsersController;
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


Route::get('/get', [UsersController::class, 'index']);
Route::post('/save', [UsersController::class, 'save']);
Route::put('/update', [UsersController::class, 'update']);
Route::delete('/delete', [UsersController::class, 'delete']);
