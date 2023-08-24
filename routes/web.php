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
Route::get('/login','To_doController@login')->name('login');
Route::get('/registration','To_doController@registration')->name('registration');
Route::post('/login','To_doController@loginPost')->name("loginpost");
Route::post('/registration','To_doController@registrationPost')->name("registrationpost");
Route::get('/logout','To_doController@logout')->name('logout');
Route::group(['middleware'=>'auth'],function(){
    Route::resource('start', 'To_doController'); 
});
