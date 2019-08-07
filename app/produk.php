<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    
    protected $fillable = [
        'nama', 'slug', 'img','harga','deskripsi','stok','berat','user_id'
    ];

}
