<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PostController;
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

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/about', [WebsiteController::class, 'about'])->name('about');

//Auth::routes();
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::resource('/posts', PostController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
