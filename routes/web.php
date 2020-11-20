<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\membersController;
use App\Http\Controllers\actorController;
use App\Http\Controllers\tagController;
use App\Http\Controllers\postController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


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


Route::get('/myproducts', [membersController::class, 'goback']);
Route::delete('/myproducts/{id}', [membersController::class, 'gobackdestroy']);
Route::delete('/myproductsDeleteAll', [membersController::class, 'deleteAll']);

// Route::post('/members', [membersController::class, 'store']);
Route::resource('/members', membersController::class);
Route::resource('/actor', actorController::class);
Route::resource('/tag', tagController::class);
Route::resource('/post', postController::class);

// Route::get('myproducts', 'ProductController', 'index');
// Route::get('myproducts', \App\Http\Controllers\ProductController::class, 'index');
// Route::get('myproducts/{id}', ProductController::class, 'destroy');
// Route::get('myproductsDeleteAll', ProductController::class, 'deleteAll');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {

	Route::resource('roles', RoleController::class);
	Route::resource('users', UserController::class);
	Route::resource('products', ProductController::class);

});