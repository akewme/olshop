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

    public function index(){
        $produk = produk::orderBy("created_at","DESC")->paginate(9);
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
        
        $produk = produk::find($id);
        $produk->nama = $req->nama;
        // $produk->slug = Str::slug($req->nama, "-");
        $produk->img = $req->img;
        $produk->harga = $req->harga;
        $produk->deskripsi = $req->deskripsi;
        $produk->stok = $req->stok;
        $produk->berat = $req->berat;
        $produk->user_id = Auth::user()->id;
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
