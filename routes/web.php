<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\BuilderController::class, 'create']);
Route::post('/store', [App\Http\Controllers\BuilderController::class, 'store'])->name('store');
Route::post('/validate', [App\Http\Controllers\FormController::class, 'store'])->name('validate');

Route::prefix('dynamic-forms')
    ->name('dynamic-forms.')->group(function () {
        // Dummy route so we can use the route() helper to give formiojs the base path for this group
        Route::get('/')->name('index');
        Route::get('form', [App\Http\Controllers\DynamicFormsResourceController::class, 'index']);
        Route::get('form/{resource}', [App\Http\Controllers\DynamicFormsResourceController::class, 'resource']);
        Route::get('form/{resource}/submission', [App\Http\Controllers\DynamicFormsResourceController::class, 'resourceSubmissions']);
});
