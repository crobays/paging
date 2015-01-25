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

Route::get('/', function()
{
	return 'home';//View::make('pages.index');
});

Route::pattern('lang', '(nl|en)');

Route::get('/{lang}/{segs?}', function(){
	return Redirect::to('/'.Request::segment(2))->withCookie(Cookie::make('locale', Request::segment(1)));
});
Route::post('/contact-email', 'MailController@consumerContact');
Route::get('/{page?}', "PageController@page");
