<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_detail extends Model
{
    protected $fillable = [
        'transaksi_id', 
        'produk_id',
        'catatan',
        'qty',
        'harga'
    ];
}
