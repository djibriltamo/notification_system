<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/befriend/{id_recipient}', [UserController::class, 'befriend'])->name('befriend');
Route::get('/accept_friend/{sender_id}', [UserController::class, 'accept_friend'])->name('accept_friend');
Route::get('/denied_friend/{sender_id}', [UserController::class, 'denied_friend'])->name('denied_friend');