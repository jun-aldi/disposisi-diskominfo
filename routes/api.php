<?php

use App\Http\Controllers\API\StatusController;
use App\Http\Controllers\API\UserController;
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

Route::post('register', [UserController::class,'register']);
Route::post('statuscreate', [StatusController::class, 'status_create']);
Route::middleware('auth:sanctum')->group(function() {

});
