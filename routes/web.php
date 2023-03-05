<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('contacts', [\App\Http\Controllers\Firebase\ContactController::class, 'index']);
Route::get('add-contact', [\App\Http\Controllers\Firebase\ContactController::class, 'create']);
Route::get('edit-contact/{id}', [\App\Http\Controllers\Firebase\ContactController::class, 'edit']);
Route::post('add-contact', [\App\Http\Controllers\Firebase\ContactController::class, 'store']);
Route::put('update-contact/{id}', [\App\Http\Controllers\Firebase\ContactController::class, 'update']);
Route::delete('delete-contact/{id}', [\App\Http\Controllers\Firebase\ContactController::class, 'destroy']);
