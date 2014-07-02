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
Route::get('/{gallery?}', array('as' => 'gallery_index', 'uses' => 'GalleryController@index'))->where('gallery', '\d+');
Route::post('/gallery/edit', array('as' => 'gallery_do_edit', 'uses' => 'GalleryController@doEdit'));
Route::get('/gallery/edit/{gallery?}', array('as' => 'gallery_edit', 'uses' => 'GalleryController@edit'))->where('gallery', '\d+');
Route::get('/gallery/delete/{gallery?}', array('as' => 'gallery_delete', 'uses' => 'GalleryController@delete'))->where('gallery', '\d+');
Route::get('/gallery/view/{gallery?}', array('as' => 'gallery_view', 'uses' => 'GalleryController@view'))->where('gallery', '\d+');

//User
Route::get('/register', array('as' => 'user_register', 'uses' => 'UserController@register'));
Route::post('/register', array('as' => 'user_do_register', 'uses' => 'UserController@register'));
Route::get('/login', array('as' => 'user_login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'user_do_login', 'uses' => 'UserController@doLogin'));
Route::get('/logout', array('as' => 'user_logout', 'uses' => 'UserController@logout'));

//Image
Route::post('/image/upload/{gallery}', array('as' => 'image_upload', 'uses' => 'ImageController@upload'));