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

Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@register']);


// call the login's view
Route::get('/login', ['uses' => 'Controller@effectLogin']);
Route::post('/login', ['as' => 'user.login','uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard','uses' => 'DashboardController@index']);


Route::get('getBack', ['as' => 'movement.getBack', 'uses' => 'MovementsController@getBack']);
Route::post('getBack', ['as' => 'movement.storeGetBack', 'uses' => 'MovementsController@storeGetBack']);

Route::get('movement', ['as' => 'movement.application', 'uses' => 'MovementsController@application']);
Route::post('movement', ['as' => 'movement.application.store', 'uses' => 'MovementsController@storeApplication']);
Route::get('user/movement', ['as' => 'movement.index', 'uses' => 'MovementsController@index']);
Route::get('movement/all', ['as' => 'movement.all', 'uses' => 'MovementsController@all']);


Route::resource('user', 'UsersController');
Route::resource('instituition', 'InstituitionsController');
Route::resource('group', 'GroupsController');
Route::resource('instituition.products', 'ProductsController');


Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);