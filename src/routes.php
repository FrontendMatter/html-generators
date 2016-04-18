<?php
Route::get('/', function() {
   return View::make("html-generators::documentation.index");
});

Route::get('/documentation', function() {
    return View::make("html-generators::documentation.index");
});

Route::group(['prefix'=>'documentation'], function() {
	Route::get('{component}', function($component) {
		return View::make("html-generators::documentation.$component");
	});
});