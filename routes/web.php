<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('starting_page');
});

Route::get('/info', function () {
    return view('info');
});

//Route::get('/test', [App\Http\Controllers\RecipeController::class, 'index'] );
//Route::get('/test/{name}/{age}', [App\Http\Controllers\RecipeController::class, 'index'] );

// Receptek CRUD
Route::resource('/recipe', App\Http\Controllers\RecipeController::class);

// Címkék CRUD
Route::resource('/tag', App\Http\Controllers\TagController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
