<?php
// User
    Route::prefix('user')->group(function () {
        // get user Profile 'user'
        Route::get('/', 'userController@index');
        // Update Profile 'user/update'
        Route::post('/update', 'userController@update');
    });

    
        
    // Produk
    include "routes/produk.php";
    // Transaksi
    include "routes/transaksi.php";
