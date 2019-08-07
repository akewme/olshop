@extends('layouts.app')
@section('css-after')
    <style>
        .login{
            background-image: url(../login.png);
            background-size: cover;
            height: 350px;
            box-shadow: 0 5px 20px 1px #ccc;
            border-radius: 10px;
            margin-top: 150px;
        }
        .login:hover{
            margin-top: 100px;
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
            <div class="login animated swing">
                <h4 class="px-4 pt-4">{{ __('Reset Password') }}</h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-5">
                                <input placeholder="example@mail.com" id="email" type="email" class="form-control form-login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary btn-login">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                <br>
                                <a class="btn btn-link pt-3" href="/login">Login Account</a>
                                <br>
                                <a class="btn btn-link pt-3" href="/register">Register Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
