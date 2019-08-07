@extends('layouts.app')
@section('css-after')
    <style>
        .login{
            background-image: url(login.png);
            background-size: cover;
            height: 450px;
            box-shadow: 0 5px 20px 1px #ccc;
            border-radius: 10px;
            margin-top: 120px;
        }
        .login:hover{
            margin-top: 80px;
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
            <div  class="login animated jello">
               <h4 class="px-4 pt-3">Login</h4>
                <div class="card-body p-lg-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-12 ">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-5">
                                <input placeholder="example@mail.com" id="email" type="email" class="form-control form-login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-4">
                                <input placeholder="***" id="password" type="password" class="form-control form-login  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                </button>
                                <br>
                                <a class="btn btn-link pt-3" href="/register">Register Account</a>
                                <br>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
