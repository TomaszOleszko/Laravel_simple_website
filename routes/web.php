<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/software', 'App\Http\Controllers\SoftwareController');
    Route::get('/user-software', [App\Http\Controllers\UserController::class, 'userSoftware'])->name('userSoftware');
    Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::match(['put', 'patch'], '/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
});

Auth::routes();


