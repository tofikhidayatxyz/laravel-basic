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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Handling admin routing
 */


Route::prefix('/admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function() {
    Route::get('/', 'AdminController@index')->name('index');

    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/', 'Admin\UserController@index')->name('index');
        Route::get('/create', 'Admin\UserController@create')->name('create');
        Route::post('/create', 'Admin\UserController@store')->name('store');
        Route::get('/user/{id}', 'Admin\UserController@edit')->name('edit');
        Route::put('/update', 'Admin\UserController@update')->name('update');
        Route::delete('/delete', 'Admin\UserController@delete')->name('delete');
    });
});




/**
 * Handling teacher routing
 */

Route::prefix('/teacher')->middleware(['auth', 'role:teacher,admin'])->name('teacher.')->group(function() {
    Route::get('/', 'TeacherController@index')->name('index');
}); 


/**
 * Handling user routing
 */

Route::prefix('/user')->middleware(['auth', 'role:user,admin'])->name('user.')->group(function() {
    Route::get('/', 'UserController@index')->name('index');
}); 


