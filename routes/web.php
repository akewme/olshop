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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/produk', 'HomeController@produk');
Route::get('/admin/transaksi', 'HomeController@transaksi');

Route::post('/upload-image', 'homeController@uploadImage');

// API
// Produk
Route::middleware('auth')->prefix('web')->group(function () {

    include "route.php";

});
