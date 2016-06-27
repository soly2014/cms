<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/* SingleTon Start */

$singletonarray = [
						'at'=>'admin',
						'themes'=>'themes.master',
						'aurl'=>'admin',
						'language'=>['ar','en'],
				  ];
foreach ($singletonarray as $key => $value) {
									  	
					app()->singleton($key,function() use($value)
					{
						return $value;
					});

		 }				  

/* End SingleTon */



/*
*
* ADMIN CREDENTIALS
*
*/

Route::group(['middleware' => ['web']], function () {
    
	Route::group(['prefix'=>'admin'],function(){
		
        Route::get('login', ['as' => 'login', 'uses' => 'Admin\HomeController@login']);
        Route::post('login', ['as' => 'login', 'uses' => 'Admin\HomeController@post_login']);

		Route::group(['middleware'=>'auth_admin'],function(){

		Route::get('/','Admin\HomeController@Index');
		Route::get('logout','Admin\HomeController@logout');

		Route::get('settings','Admin\Settings@show');
		Route::post('settings','Admin\Settings@save');

		Route::resource('department_news','DepNews');
		Route::resource('news','NewsController');

		Route::resource('department_product','DepProduct');
		Route::post('department_product/check/parent','DepProduct@check_parent');







	   });

	});


});
