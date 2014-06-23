<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Gellery
Route::model('gallery', 'Gallery');
Route::get('/gallery/{gallery?}', array('as' => 'gallery_index', 'uses' => 'GalleryController@index'));
Route::post('/gallery-edit', array('as' => 'gallery_do_edit', 'uses' => 'GalleryController@doEdit'));

//User
Route::get('/register', array('as' => 'user_register', 'uses' => 'UserController@register'));
Route::post('/register', array('as' => 'user_do_register', 'uses' => 'UserController@register'));
Route::get('/login', array('as' => 'user_login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'user_do_login', 'uses' => 'UserController@doLogin'));
Route::get('/logout', array('as' => 'user_logout', 'uses' => 'UserController@logout'));