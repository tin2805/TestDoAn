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
    return view('welcome');
});
Route::get('/login', 'App\Http\Controllers\SigninController@showLogin')->name('login');
Route::post('/login', 'App\Http\Controllers\SigninController@login');
//AI
Route::get('/ai-ask', 'App\Http\Controllers\ChatGptController@index')->name('ai.index');
Route::post('/ai-ask', 'App\Http\Controllers\ChatGptController@textCompletion')->name('ai.ask');