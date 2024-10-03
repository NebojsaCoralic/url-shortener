<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\UrlController::class, 'index'])->name('home');

    Route::resource('companies', CompanyController::class);
    Route::resource('urls', UrlController::class);

    Route::post('urls/{url}/expire', [UrlController::class, 'extendExpiry'])->name('urls.extend-expiry');

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('users', UserController::class);
    });
});

Route::get('{hash}', [UrlController::class, 'redirect'])->name('urls.redirect');

