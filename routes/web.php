<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;

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



// AJAX CRUD OPERATION
Route::controller(registrationController::class)->group(function () { 
Route::get('/show', 'show')->name('register.index');
Route::post('/store','store')->name('register.store');
Route::post('/edit/{id}','edit')->name('user.edit');
Route::post('update','Update')->name('user.update');
Route::post('delete/{id}','delete')->name('users.delete');
});
