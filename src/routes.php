<?php

Route::group(['prefix'=>'html-generators'], function()
{
	Route::get('{component}', function($component)
	{
		return View::make("html-generators::$component");
	});
});