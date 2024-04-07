<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::fallback(function(){
    return view('404');
});

Route::controller(UserController::class)->group(function(){
    Route::get('register', 'Register')->name('register');
    Route::get('login', 'Login')->name('login');
    Route::post('register-post', 'registerPost')->name('register.post');
    Route::post('login-post', 'loginPost')->name('login.post');
    Route::get('dashboard', 'Dashboard');
    Route::get('logout', 'Logout')->name('logout');
    Route::post('edit-record', 'editRecord')->name('edit.record');
    Route::post('delete-record', 'deleteRecord')->name('delete.record');
});
