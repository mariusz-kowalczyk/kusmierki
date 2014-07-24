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

//Home
Route::get('/', array('as' => 'home_index', 'uses' => 'HomeController@index'));

//Gellery
Route::model('gallery', 'Gallery');
Route::get('/galeria/{gallery?}', array('as' => 'gallery_index', 'uses' => 'GalleryController@index'))->where('gallery', '\d+');
Route::post('/galeria/edit', array('as' => 'gallery_do_edit', 'uses' => 'GalleryController@doEdit'));
Route::get('/galeria/edit/{gallery?}', array('as' => 'gallery_edit', 'uses' => 'GalleryController@edit'))->where('gallery', '\d+');
Route::get('/galeria/delete/{gallery?}', array('as' => 'gallery_delete', 'uses' => 'GalleryController@delete'))->where('gallery', '\d+');
Route::get('/galeria/szczegóły/{gallery?}', array('as' => 'gallery_view', 'uses' => 'GalleryController@view'))->where('gallery', '\d+');

//User
Route::model('user', 'User');
Route::get('/rejestracja', array('as' => 'user_register', 'uses' => 'UserController@register'));
Route::post('/rejestracja', array('as' => 'user_do_register', 'uses' => 'UserController@register'));
Route::get('/logowanie', array('as' => 'user_login', 'uses' => 'UserController@login'));
Route::post('/logowanie', array('as' => 'user_do_login', 'uses' => 'UserController@doLogin'));
Route::get('/logout', array('as' => 'user_logout', 'uses' => 'UserController@logout'));
Route::get('/cookie', array('as' => 'user_cookie_agree', 'uses' => 'UserController@cookieAgree'));

//Image
Route::model('image', 'Image');
Route::post('/zdjęcie/upload/{gallery}', array('as' => 'image_upload', 'uses' => 'ImageController@upload'))->where('gallery', '\d+');
Route::get('/pobierz-zdjęcie/{image?}', array('as' => 'image_download', 'uses' => 'ImageController@download'))->where('image', '\d+');
Route::post('/image/edit', array('as' => 'image_do_edit', 'uses' => 'ImageController@doEdit'));
Route::get('/image/edit/{image?}', array('as' => 'image_edit', 'uses' => 'ImageController@edit'))->where('image', '\d+');
Route::get('/image/delete/{image?}', array('as' => 'image_delete', 'uses' => 'ImageController@delete'))->where('image', '\d+');
Route::get('/zdjęcie/szczegóły/{image?}', array('as' => 'image_view', 'uses' => 'ImageController@view'))->where('image', '\d+');

//Notice
Route::model('notice', 'Notice');
Route::get('/ogłoszenia', array('as' => 'notice_index', 'uses' => 'NoticeController@index'));

//only admin
if(User::hasRole('admin')) {
    Route::get('/user/index', array('as' => 'user_index', 'uses' => 'UserController@index'));
    Route::get('/user/edit/{user}', array('as' => 'user_edit', 'uses' => 'UserController@edit'));
    Route::post('/user/edit', array('as' => 'user_do_edit', 'uses' => 'UserController@doEdit'));
    Route::get('/user/active/{user}', array('as' => 'user_do_active', 'uses' => 'UserController@active'))->where('user', '\d+');
    
    Route::get('/role/index', array('as' => 'role_index', 'uses' => 'RoleController@index'));
}

if(User::hasRole('edit_notice')) {
    Route::get('/notice/edit/{notice?}', array('as' => 'notice_edit', 'uses' => 'NoticeController@edit'));
    Route::post('/notice/edit', array('as' => 'notice_do_edit', 'uses' => 'NoticeController@doEdit'));
    Route::get('/notice/delete/{notice?}', array('as' => 'notice_delete', 'uses' => 'NoticeController@delete'));
}

Route::model('site', 'Site');
if(User::hasRole('edit_sites')) {
    Route::get('/site/index', array('as' => 'site_index', 'uses' => 'SiteController@index'));
    Route::get('/site/edit/{site?}', array('as' => 'site_edit', 'uses' => 'SiteController@edit'));
    Route::post('/site/edit', array('as' => 'site_do_edit', 'uses' => 'SiteController@doEdit'));
    Route::get('/site/delete/{site?}', array('as' => 'site_delete', 'uses' => 'SiteController@delete'));
    Route::get('/site/preview/{site}', array('as' => 'site_preview', 'uses' => 'SiteController@show'));
}

$route_site_show_generate_pattern = function() {
    $sites = array();
    foreach(Site::where('visibility', '=', 1)->get(array('link')) as $s) {
        $sites[] = '(' . $s->link . ')';
    }
    $pattern = implode('|', $sites);
    if(empty($pattern)) {
        //taki żeby nic nie złapał
        $pattern = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    }
    return $pattern;
};
Route::get('/{site_link}', array('as' => 'site_show', 'uses' => 'SiteController@show'))->where('site_link', $route_site_show_generate_pattern());
