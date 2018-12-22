<?php

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

//Route::post('/', 'PostController');
Route::middleware(['auth'])->group(function (){
    Route::resource('/', 'PostController');
    Route::put('/post/{id}/edit', 'PostController@update');
    Route::delete('/post/{id}', 'PostController@destroy');
    Route::get('/user/{user}/edit', 'UserController@editProfile')->name('profile');
    Route::post('/user/{user}/edit', 'UserController@upload');
});
Auth::routes();

Route::get('/user/{id}/home', 'HomeController@index')->name('home');
