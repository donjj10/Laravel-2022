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


require __DIR__.'/auth.php';

// ADMIN ROLE GROUP
Route::group(['middleware' => 'is_super_admin', 'is_admin'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'is_super_admin'], function () {
    Route::resource('/users', 'App\Http\Controllers\UserController');
    
});

Route::group(['middleware' => 'is_admin'], function () {
    Route::resource('discounts', 'App\Http\Controllers\DiscountController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/payments', 'App\Http\Controllers\PaymentController@index');
});