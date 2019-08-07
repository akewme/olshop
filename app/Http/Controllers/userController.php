<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class userController extends Controller
{
    public function index(){
        return Auth::user();
    }
    //
    public function update(Request $req){
        $err = array();
        $user  = User::find(Auth::user()->id);
        $user->name = ($req['name']) ? $req['name'] : $user->name;

        if($req['username'] AND $req['username'] != Auth::user()->username){

            $username  = User::where("username",$req['username'])->first();
            if($username){
                $e = "Username ".$req['username']." Tidak Bisa digunakan";
                array_push($err,$e);
            }else{
                $user->username = $req['username'];
            }
        }

        if($req['email'] AND $req['email'] != Auth::user()->email ){
            $email  = User::where("email",$req['email'])->first();
            if($email){
                $e = "Email ".$req['email']." Sudah Terdaftar";
                array_push($err,$e);
            }else{
                $user->email = $req['email'];
            }
        }

        if($req['avatar'] || $req['avatar'] != Auth::user()->avatar ){
            $avatar  = $req['avatar'];
            $user->avatar = $avatar;
        }

        $user->update();
        return array($user,$err);
    }
}
