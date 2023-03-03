<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;

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


Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});
 Route::controller(RegisterController::class)->group(function() {
     Route::get('register', 'index')->name('register.index');
     Route::post('register', 'store')->name('register.store');
 });

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'index')->name('dashboard-overview-1');
    });
    Route::controller(TodoController::class)->group(function() {
        Route::post('todo/store', 'store')->name('todo.store');
        Route::post('todo/update/{todo}', 'update')->name('todo.update');
        Route::get('todo/list', 'list')->name('todo.list');
        Route::delete('todo/delete/{todo}', 'delete')->name('todo.delete');
    });
    
    Route::controller(TaskController::class)->group(function() {
        Route::post('task/store', 'store')->name('task.store');
        Route::post('task/update/{task}', 'update')->name('task.update');
        Route::delete('task/delete/{task}', 'delete')->name('task.delete');
    });
});
