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


// Receptek CRUD
Route::resource('/recipe', App\Http\Controllers\RecipeController::class);

// Címkék CRUD
Route::resource('/tag', App\Http\Controllers\TagController::class);

// Felhasználók CRUD
Route::resource('/user', App\Http\Controllers\UserController::class);

// Attach tags to recipes
Route::get('/recipe/{recipe_id}/tag/{tag_id}/attach', [App\Http\Controllers\recipeTagController::class, 'attachTag']);
Route::get('/recipe/{recipe_id}/tag/{tag_id}/detach', [App\Http\Controllers\recipeTagController::class, 'detachTag']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/recipe/tag/{tag_id}', [App\Http\Controllers\recipeTagController::class, 'getFilteredRecipes'])->name('recipe_tag');

