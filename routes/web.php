<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwoFactorController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('twofactor');

// Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
// Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

// Route::('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

Route::resource('verify', TwoFactorController::class, ['index', 'store']);

// Route::resource('items', ItemController::class);

// Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
// Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
// Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');
