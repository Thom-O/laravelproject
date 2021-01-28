<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HousesController;

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

Route::get('/', [HousesController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HousesController::class, 'overview'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{id}', [HousesController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->put('/dashboard/edit', [HousesController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->delete('/dashboard/delete', [HousesController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard/add', [HousesController::class, 'create']);

