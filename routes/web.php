<?php

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

Route::get('/', 'Frontend\FrontendController@index');
Route::get('/post', 'Frontend\FrontendController@post');


Route::get('/register', 'Frontend\FrontendController@RegistrationForm')->name('register');
Route::post('/register', 'Frontend\FrontendController@ProccessRegistration');

Route::get('/login', 'Frontend\FrontendController@ShowLoginForm')->name('login');
Route::post('/login', 'Frontend\FrontendController@ProccessLogin');
Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', 'Backend\DashboardController@showDashboard')->name('dashboard');
    Route::get('/logout', 'Frontend\FrontendController@logout')->name('logout');
    Route::resource('/posts', 'Backend\PostController');
});

Route::get('/categories', 'Backend\CategoryController@index')->name('categories.index');
Route::get('/categories/add', 'Backend\CategoryController@create')->name('categories.create');
Route::post('/categories', 'Backend\CategoryController@store')->name('categories.store');
Route::get('/categories/{id}', 'Backend\CategoryController@show')->name('categories.show');
Route::get('/categories/{id}/edit', 'Backend\CategoryController@edit')->name('categories.edit');
Route::put('/categories/{id}', 'Backend\CategoryController@update')->name('categories.update');
Route::delete('/categories/{id}', 'Backend\CategoryController@delete')->name('categories.delete');

Route::get('/verify/{token}', 'Frontend\FrontendController@verify')->name('verify');

