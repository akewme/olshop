<?php

// Transaksi
Route::prefix('transaksi')->group(function () {

    Route::get('/','transaksiController@index');

    // get transaksi All
    Route::get('/','transaksiController@index');

    // get transaksi by ID
    Route::get('/{id}','transaksiController@single');

    // Tambah transaksi
    Route::post('/tambah','transaksiController@tambah');
    
    // Edit transaksi
    Route::post('/edit/{id}','transaksiController@edit');

    // Tambah transaksi Img
    Route::post('/tambah/img/{id}','transaksiController@tambahGambar');
    
    // Get transaksi Img
    Route::get('/img/{id}','transaksiController@transaksiImg');
});