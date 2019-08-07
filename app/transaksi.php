<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = [
        'user_id', 
        'penjual_id',
        'pembayaran',
        'bukti_pembayaran',
        'pengiriman',
        'ongkir',
        'total_harga',
        'status'
    ];
}
