<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'layout');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/registration', 'AuthController@registration')->name('registration');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::post('/login', 'AuthController@loginPost')->name("login.post");
Route::post('/registration', 'AuthController@registrationPost')->name("registration.post");

Route::group(['middleware' => 'auth'], function () {
    Route::resource('start', 'TodoController');
});
