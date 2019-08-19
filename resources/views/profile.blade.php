@extends('layouts.app')
@section('css-after')
<style>
    .profile{
        height: 450px;
        box-shadow: 0 5px 20px 1px #ccc;
        border-radius: 10px;
        margin-top: 80px;
        background: #fff;
    }
    .profile:hover{
        margin-top: 40px;
        transition: .5s;
        box-shadow: 0 20px 35px #1c5c9c;
    }
    @media (max-width:800px){
        .profile{
            margin-top: 0px;
            height: 600px;
        }
        .profile:hover{
            margin-top: 0;
        }
    }
</style>
@endsection
@section('content')
<div class="container px-3">
    <div class="row justify-content-center">
        <div class="col-md-12 p-lg-4">
            <div class= "animated zoomInUp">
                <div class="card-body">
                    <h4 class="col-md-12 d-none d-lg-block pt-4">My Profile</h4>
                    <div class="col-md-12 col-lg-6 float-right pt-4 text-center">
                        <img width="50%" src="/logo.png">
                    </div>
                    <div class="col-md-12 col-lg-6 float-left">
                        <form method="POST" action="{{ url('/web/user/update') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">Nama Olshop</label>

                                <div class="col-md-12">
                                    <input placeholder="Nama Olshop" type="text" class="form-control btn-topleft  @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">Username</label>

                                <div class="col-md-12">
                                    <input placeholder="Username" type="text" class="form-control btn-topleft  @error('name') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-12">
                                    <input placeholder="example@mail.com" id="email" type="email" class="form-control btn-topleft  @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info btn-topleft btn-block">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
