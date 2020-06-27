<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');


Route::group(['prefix' => 'topics'], function(){
   Route::post('/', 'TopicController@store')->middleware('auth:api');
   Route::get('/', 'TopicController@index');
   Route::get('/{topic}', 'TopicController@show');
   Route::patch('/{topic}', 'TopicController@update')->middleware('auth:api');
   Route::delete('/{topic}', 'TopicController@destroy')->middleware('auth:api');

   //Post Route Groups
    Route::group(['prefix'=>'/{topic}/posts'], function(){
       Route::post('/', 'PostController@store')->middleware('auth:api');
       Route::get('/{post}', 'PostController@show');
       Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
       Route::delete('/{post}', 'PostController@destroy')->middleware('auth:api');

       //Likes
        Route::group(['prefix'=>'/{post}/likes'], function(){
           Route::post('/', 'PostLikeController@store')->middleware('auth:api');
        });
    });


});
