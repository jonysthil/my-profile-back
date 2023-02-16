<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login.
Route::get ('/', [UserController::class, 'loginForm']);
Route::get ('/login', [UserController::class, 'loginForm']);
Route::post('/validar', [UserController::class, 'validar']);
Route::get ('/logout', [UserController::class, 'logout']);

Route::group(['middleware' => ['jony']], function () {

    Route::get('/home', [DashboardController::class, 'index']);

});
