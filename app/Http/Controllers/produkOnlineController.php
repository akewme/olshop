<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\produk_img;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class produkOnlineController extends Controller
{

    public function index(Request $req){

        $where = "produks.user_id != ''";

        $orderBy = "produks.created_at";
        $urutan = "DESC";

        // return $req->urutkan;

        if($req->urutkan){
            if($req->urutkan == "termurah"){
                $orderBy = "produks.harga";
                $urutan = "ASC";
            }else if($req->urutkan == "termahal"){
                $orderBy = "produks.harga";
                $urutan = "DESC";
            }
        }

        if($req->search != ""){
            $where .= " AND produks.nama like '%".$req->search."%'";
        }

        if($req->toko != ""){
            $where .= " AND produks.user_id = ". $req->toko;
        }

        $produk = produk::
        join("users as u","u.id","produks.user_id")
        ->select("produks.*","u.username")
        ->whereRaw($where)
        ->orderBy($orderBy,$urutan)
        ->paginate(9);

        return $produk;
        
    }

    public function single($id){
        return produk::find($id);
    }
}
