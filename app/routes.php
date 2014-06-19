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
Route::get('/', array('as' => 'gallery_index', 'uses' => 'GalleryController@index'));

//User
Route::get('/register', array('as' => 'user_register', 'uses' => 'UserController@register'));
Route::post('/register', array('as' => 'user_register_post', 'uses' => 'UserController@register'));
