<?php

// Produk
Route::prefix('produk')->group(function () {

    // get Produk All
    Route::get('/','produkController@index');

    // get Produk by ID
    Route::get('/{id}','produkController@single');

    // Tambah Produk
    Route::post('/tambah','produkController@tambah');
    
    // Edit Produk
    Route::post('/edit/{id}','produkController@edit');

    // Tambah Produk Img
    Route::post('/tambah/img/{id}','produkController@tambahGambar');
    
    // Get Produk Img
    Route::get('/img/{id}','produkController@produkImg');

});