@extends('layouts.app')
@section('css-after')
    <style>
        .login{
            background-image: url(login.png);
            background-size: cover;
            height: 550px;
            box-shadow: 0 5px 20px 1px #ccc;
            border-radius: 10px;
            margin-top: 80px;
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
            <div class="login animated swing">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
