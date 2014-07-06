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
Route::model('image', 'Image');
Route::post('/image/upload/{gallery}', array('as' => 'image_upload', 'uses' => 'ImageController@upload'))->where('gallery', '\d+');
Route::get('/image/download/{image?}', array('as' => 'image_download', 'uses' => 'ImageController@download'))->where('image', '\d+');
Route::post('/image/edit', array('as' => 'image_do_edit', 'uses' => 'ImageController@doEdit'));
Route::get('/image/edit/{image?}', array('as' => 'image_edit', 'uses' => 'ImageController@edit'))->where('image', '\d+');
Route::get('/image/delete/{image?}', array('as' => 'image_delete', 'uses' => 'ImageController@delete'))->where('image', '\d+');
Route::get('/image/view/{image?}', array('as' => 'image_view', 'uses' => 'ImageController@view'))->where('image', '\d+');

//only admin
if(User::hasRole('admin')) {
    Route::get('/user/index', array('as' => 'user_index', 'uses' => 'UserController@index'));
}