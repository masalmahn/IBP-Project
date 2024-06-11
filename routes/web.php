<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers\RegisterController;
use App\Http\Controllers\AuthControllers\LoginController;
use App\Http\Controllers\AuthControllers\ResetPassword;
use App\Http\Controllers\AuthControllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {return redirect('/dashboard');});

    Route::get('/dashboard',    [HomeController::class, 'index'])->name('home');

    Route::get('/register',     [RegisterController::class, 'create'])->name('register');
    Route::post('/register',    [RegisterController::class, 'store'])->name('register.perform');


	Route::get('/profile',      [ProfileController::class, 'show'])->name('profile');
	Route::post('/profile',     [ProfileController::class, 'update'])->name('profile.update');
	Route::get('/new-user',     [ProfileController::class, 'create'])->name('user.create');
	Route::post('/new-user',    [ProfileController::class, 'store'])->name('user.store');

    Route::group(['prefix' => 'admins/', 'as' => 'admins.', 'middleware' => 'role:Super-Admin'], function () {
        Route::get('',       [AdminsController::class, 'show'])->name('show');
        Route::get('create',    [AdminsController::class, 'create'])->name('create');
        Route::post('store',    [AdminsController::class, 'store'])->name('store');
        Route::get('edit/{username}',      [AdminsController::class, 'edit'])->name('edit');
        Route::post('update',   [AdminsController::class, 'update'])->name('update');
        Route::post('delete/{username}',   [AdminsController::class, 'delete'])->name('delete');

    });

    Route::group(['prefix' => 'materials/', 'as' => 'materials.'], function () {
        Route::get('',                  [MaterialsController::class, 'show'])->name('show');
        Route::get('create',            [MaterialsController::class, 'create'])->name('create');
        Route::post('store',            [MaterialsController::class, 'store'])->name('store');
        Route::get('edit/{id}',         [MaterialsController::class, 'edit'])->name('edit');
        Route::post('update',           [MaterialsController::class, 'update'])->name('update');
        Route::group(['middleware' => 'role:Super-Admin'], function () {
            Route::post('delete/{id}',      [MaterialsController::class, 'delete'])->name('delete');
        });

    });

	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

});
