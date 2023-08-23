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
Route::get('/forgot-pass', 'App\Http\Controllers\SigninController@forgotPassView')->name('forgotPassView');
Route::post('/forgot-pass', 'App\Http\Controllers\SigninController@forgotPass')->name('forgotPass');
Route::post('/forgot-pass/check-code', 'App\Http\Controllers\SigninController@forgotPassInput')->name('forgotPassInput');
Route::post('/change-pass', 'App\Http\Controllers\SigninController@changePassword')->name('changePass');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/logout', 'App\Http\Controllers\DashboardController@logout')->name('logout');
    
    //CheckInOut
    Route::get('/attendance', 'App\Http\Controllers\DashboardController@attendance')->name('attendance');
    Route::get('/checkin', 'App\Http\Controllers\DashboardController@checkIn');
    Route::get('/checkout', 'App\Http\Controllers\DashboardController@checkOut');

    //Mail
    Route::get('support/{id}/reply', 'App\Http\Controllers\SupportController@reply')->name('support.reply');
    Route::post('support/{id}/reply', 'App\Http\Controllers\SupportController@replyAnswer')->name('support.reply.answer');
    Route::get('support/grid', 'App\Http\Controllers\SupportController@grid')->name('support.grid');
    Route::resource('support', '\App\Http\Controllers\SupportController');
    
    //Dark Mode
    Route::get('/change-mode', 'App\Http\Controllers\DashboardController@changeMode')->name('change.mode');
    
    //Profile
    Route::get('/profile', 'App\Http\Controllers\EmployeeController@profile')->name('profile');
    Route::post('/profile/update-account', 'App\Http\Controllers\EmployeeController@updateAccount')->name('update.account');
    Route::post('/profile/update-password', 'App\Http\Controllers\EmployeeController@updatePassword')->name('update.password');
    
    //AI
    Route::get('/ai-ask', 'App\Http\Controllers\ChatGptController@index')->name('ai.index');
    Route::post('/ai-ask', 'App\Http\Controllers\ChatGptController@textCompletion')->name('ai.ask');

});


//admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});