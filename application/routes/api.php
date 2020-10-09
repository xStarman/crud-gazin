<?php

use App\Http\Controllers\DevelopersController;
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

Route::post('/developers', [DevelopersController::class, 'createDeveloper']);
Route::get('/developers/{id?}', [DevelopersController::class, 'listDevelopers']);
Route::put('/developers/{id}', [DevelopersController::class, 'updateDeveloper']);
