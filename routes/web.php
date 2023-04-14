<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Main'], function (){
    Route::get('/', 'IndexController')->name('main.index');
});
Route::group(['namespace' => 'App\Http\Controllers\Post', 'prefix' => 'posts'], function (){
    Route::get('/', 'IndexController')->name('post.index');
    Route::get('/create', 'CreateController')->name('post.create');
    Route::post('/', 'StoreController')->name('post.store');
    Route::get('/{post}', 'ShowController')->name('post.show');
    Route::get('/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/{post}', 'UpdateController')->name('post.update');
    Route::delete('/{post}', 'DestroyController')->name('post.destroy');
});
