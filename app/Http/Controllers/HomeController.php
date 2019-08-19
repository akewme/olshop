<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function produk()
    {
        return view('produk');
    }
    public function transaksi()
    {
        return view('transaksi');
    }
    public function profile()
    {
        return view('profile');
    }
    public function uploadImage(Request $request){

        $image_file = $request->image;
        list($type, $image_file) = explode(';', $image_file);
        list(, $image_file)      = explode(',', $image_file);
        $image_file = base64_decode($image_file);
        $image_name= time().'_'.rand(100,999).'.png';
        $path = public_path('img/'.$image_name);
        file_put_contents($path, $image_file);

        return $image_name;
    }

}
