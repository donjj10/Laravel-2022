<?php

use App\Http\Controllers\PaymentController;
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
Route::group(['middleware' => 'role:administrator|superadministrator'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'role:administrator'], function () {
    Route::resource('discounts', 'App\Http\Controllers\DiscountController');
});

//Route::get('/discounts', [DiscountController::class, 'update'])->name('discounts');
Route::get('/payment',[PaymentController::class,'index'])->name('payment');
Route::get('/murugo-login', 'App\Http\Controllers\MurugoLoginController@redirectToMurugo')->name('murugo-login');
Route::get('/murugo-callback', 'App\Http\Controllers\MurugoLoginController@murugoCallback')->name('murugo-callback');