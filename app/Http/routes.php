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

Route::get('test', 'TestController@index');


/*
 * Company profile, Help & Support Routes
*/
Route::get('company', 'CompanyController@about');
Route::get('guide', 'CompanyController@guide');
Route::get('support', 'CompanyController@support');

//For safe side, old url redirect to new
Route::get( 'login', 'Auth\AuthController@getLogin');
Route::post( 'login', 'Auth\AuthController@postLogin');

/*  Login & Registration Routes */
Route::controllers([
    'user' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/*  Login Users Access Routes   */
/*Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function(){
        return redirect()->action('CompanyController@about');
    });
    Route::get('home', function(){
        return redirect()->action('CompanyController@about');
    });


    //registration not allowed to guest
    Route::get( 'register', 'Auth\AuthController@getRegister');
    Route::post( 'register', 'Auth\AuthController@postRegister');
});*/

Route::get('/', function(){
    return redirect()->action('CompanyController@about');
});
Route::get('home', function(){
    return redirect()->action('CompanyController@about');
});


//registration not allowed to guest
Route::get( 'register', 'Auth\AuthController@getRegister');
Route::post( 'register', 'Auth\AuthController@postRegister');


Route::get('lang/{lang}', function($lang){
    \Illuminate\Support\Facades\Session::set('lang', $lang);
    return redirect()->back();
});
