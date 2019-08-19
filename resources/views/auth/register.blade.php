@extends('layouts.app')
@section('css-after')
    <style>
        .login{
            background-image: url(login.png);
            background-size: cover;
            height: 550px;
            box-shadow: 0 5px 20px 1px #ccc;
            border-radius: 10px;
            margin-top: 50px;
        }
        .login:hover{
            margin-top: 40px;
            transition: .5s;
            box-shadow: 0 20px 35px #1c5c9c;
        }
        .btn-login{
            padding:8px 30px; border-radius:30px
        }
        .form-login{
            border-radius: 30px;
            padding: 16px 20px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login animated rubberBand">
                <h4 class="px-4 pt-3">{{ __('Register') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left">Nama Brand</label>

                            <div class="col-md-5">
                                <input placeholder="Nama Brand" id="name" type="text" class="form-control form-login  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-5">
                                <input placeholder="example@mail.com" id="email" type="email" class="form-control form-login  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-5">
                                <input placeholder="***" id="password" type="password" class="form-control form-login  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-5">
                                <input placeholder="***" id="password-confirm" type="password" class="form-control form-login " name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <br>
                                <a class="btn btn-link pt-3" href="/login">Login Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
