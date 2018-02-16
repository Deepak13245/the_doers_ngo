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
    return redirect()->to('auth');
});

Route::group([
    'middleware' => [ 'web', 'role:Admin' ],
    'namespace'  => 'Admin',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () {
    CRUD::resource('address', 'AddressCrudController');
});

Route::get("/auth", 'GuestController@auth');
Route::post("/sign-up", 'GuestController@register');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user-logout', 'HomeController@logout')->name('home');
Route::post('/home', 'HomeController@filter')->name('home.filter');
Route::post('/post', 'HomeController@post')->name('post.save');
Route::delete('/post/delete/{post}', 'HomeController@deletePost')->name('post.delete');
