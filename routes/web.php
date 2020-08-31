<?php

use App\Http\Controllers\ArticleButtonController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('admin');
});

Route::post('/articleButton/store', 'ArticleButtonController@store');
Route::get('articleButton/index', 'ArticleButtonController@index');

Route::get('articleLevel/index', 'ArticleLevelController@index');
Route::get('articleLevel/store', 'ArticleLevelController@store');

Route::post('/article/store', 'ArticleController@store');
Route::get('/article/index', 'ArticleController@index');

Route::post('/invoice/store', 'InvoiceController@store');

