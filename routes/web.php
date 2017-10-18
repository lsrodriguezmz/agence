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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/consultores', 'HomeController@consultores')->name('consultores');

//Route::view('/relatorio', 'relatorio')->name('relatorio');
Route::get('/relatorio', 'HomeController@relatorio')->name('relatorio');

Route::get('/grafica', 'HomeController@grafica')->name('grafica');

Route::get('/pizza', 'HomeController@pizza')->name('pizza');