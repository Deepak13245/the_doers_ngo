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

Route::get('/', 'GuestController@index');

Route::group([
    'middleware' => [ 'web', 'role:Admin' ],
    'namespace'  => 'Admin',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () {
    CRUD::resource('address', 'AddressCrudController');
    CRUD::resource('post', 'PostCrudController');
    CRUD::resource('interest', 'InterestCrudController');
    CRUD::resource('category', 'CategoryCrudController');
});

Route::get("/auth", 'GuestController@auth')->name('auth');
Route::post("/sign-up", 'GuestController@register');
Auth::routes();

// Home

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@filter')->name('home.filter');
Route::get('/user-logout', 'HomeController@logout')->name('logout');


// Posts

Route::get('/posts', 'PostController@index')->name('post');
Route::post('/posts', 'PostController@filter')->name('post.filter');
Route::post('/post', 'PostController@post')->name('post.save');
Route::delete('/post/delete/{post}', 'PostController@deletePost')->name('post.delete');

// Map

Route::get('/map', 'MapController@index')->name('map');
Route::post('/map', 'MapController@filter')->name('map.filter');