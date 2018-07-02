<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/hello', function () {
    return '<h1>Hello</h1>';
});
*/

/*
Route::get('/about/{id}/{name}', function ($id,$name) {

    return "This is user ".$id. " Name ".$name;
});


Route::get('/', function () {
    return view('welcome');
});


Route::get('/about',function(){
 return view('pages.about');
});

*/
//php artisan make:controller PagesController

//returning with controller
Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::resource('post','PostController');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
