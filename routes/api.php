<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', ['\App\Http\Controllers\Api\UserController', 'get_users']);
Route::post('/user/create', ['\App\Http\Controllers\Api\UserController', 'create_user']);
Route::put('/user/edit', ['\App\Http\Controllers\Api\UserController', 'edit_user']);
Route::delete('/user/delete', ['\App\Http\Controllers\Api\UserController', 'delete_user']);

Route::post('/calc/transport', ['\App\Http\Controllers\TransportationController', 'calculate_transport_sum']);
