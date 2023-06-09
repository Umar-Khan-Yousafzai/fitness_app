<?php

use App\Http\Controllers\API\FootStepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
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
// Route::post('login',['API\RegisterController@login','login']);

Route::post('/login',[RegisterController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/footsteps', [FootStepController::class, 'getFootSteps']);
    Route::post('/footsteps', [FootStepController::class, 'store']);
});
