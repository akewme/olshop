<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\produk_img;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class produkController extends Controller
{

    public function index(Request $req){

        $where = "produks.user_id != ''";


        if(Auth::user()->role != 1){
            // Untuk User Biasa
            $where .= "AND produks.user_id = ". Auth::user()->id;
        }

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

    public function tambah(Request $req){

        $validator = Validator::make($req->all(), [
            "nama" => "required",
            "img" => "required",
            "harga" => "required",
            "deskripsi" => "required",
            "stok" => "required",
            "berat"=> "required"
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }
        
        $produk = new produk;
        $produk->nama = $req->nama;
        $produk->slug = Str::slug($req->nama, "-");
        $produk->img = $req->img;
        $produk->harga = $req->harga;
        $produk->deskripsi = $req->deskripsi;
        $produk->stok = $req->stok;
        $produk->berat = $req->berat;
        $produk->user_id = Auth::user()->id;
        $produk->save();

        return $produk;
        
    }

    public function edit(Request $req, $id){

        $produk = produk::find($id);

        if(Auth::user()->role != 1){
            if($produk->user_id != Auth::user()->id){
                return array("Maaf Anda tidak memiliki akses untuk mengubah data ini");
            }
        }
        
        $produk->nama = ($req->nama) ? $req->nama : $produk->nama;
        $produk->img = ($req->img) ? $req->img : $produk->img;
        $produk->harga = ($req->harga) ? $req->harga : $produk->harga;
        $produk->deskripsi = ($req->deskripsi) ? $req->deskripsi : $produk->deskripsi;
        $produk->stok = ($req->stok) ? $req->stok : $produk->stok;
        $produk->berat = ($req->berat) ? $req->berat : $produk->berat;
        $produk->update();

        return $produk;
    } 

    public function tambahGambar(Request $req, $id){

        $validator = Validator::make($req->all(), [
            "img" => "required",
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }

        $produk = new produk_img;
        $produk->img = $req->img;
        $produk->produk_id = $id;
        $produk->save();

        return $produk;
    }

    public function produkImg($id){
        $produk_img = produk_img::where("produk_id",$id)->paginate(5);
        return $produk_img;
    }
}
