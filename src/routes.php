<?php
Route::get('/', function() {
   return View::make("html-generators::index");
});


Route::get('/setup', function() {
    return View::make("html-generators::setup");
});


Route::get('/setup/install-composer', function() {
    return View::make("html-generators::setup.install-composer");
});

Route::get('/tutorials', function() {
    return View::make("html-generators::tutorials");
});

Route::get('/documentation', function() {
    return View::make("html-generators::documentation.index");
});

Route::group(['prefix'=>'documentation'], function()
{
	Route::get('{component}', function($component)
	{
		return View::make("html-generators::documentation.$component");
	});
});