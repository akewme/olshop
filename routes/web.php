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
    return view('online.produk');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/produk', 'HomeController@produk');
    Route::get('/transaksi', 'HomeController@transaksi');
    Route::get('/profile', 'HomeController@profile');
    Route::post('/upload-image', 'HomeController@uploadImage');

});

// API WEB Auth
Route::middleware('auth')->prefix('web')->group(function () {

    include "route.php";

});



// API Public Online Not Authorization
Route::prefix('public')->group(function () {

    Route::prefix('produk')->group(function () {
        // get Produk All
        Route::get('/','produkOnlineController@index');

        // get Produk by ID
        Route::get('/{id}','produkOnlineController@single');
    
    });
});
