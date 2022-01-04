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
    Route::get('/user-software', [App\Http\Controllers\UserController::class, 'userSoftware'])->name('userSoftwares');
    Route::get('user/edit',function () {
        return view('user.edit');
    })->name('userEdit');
});

Auth::routes();


