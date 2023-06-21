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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/signin', 'App\Http\Controllers\SigninController@showLogin')->name('login');
Route::post('/signin', 'App\Http\Controllers\SigninController@login');
Route::get('/signup', 'App\Http\Controllers\SignupController@index')->name('register');
Route::post('/signup', 'App\Http\Controllers\SignupController@register');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
Route::get('/logout', 'App\Http\Controllers\DashboardController@logout');


//AI
Route::get('/ai-ask', 'App\Http\Controllers\ChatGptController@index')->name('ai.index');
Route::post('/ai-ask', 'App\Http\Controllers\ChatGptController@textCompletion')->name('ai.ask');