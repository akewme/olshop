<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}


    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
        }
        .navmenu{
            position: fixed;
            left: 10px;
            z-index: 100;
            width: 100px;
            bottom: 30%
        }
        .navmenu a{
            width: 100%;
            float: left;
            padding: 10px 12px;
            background: #fff;
            text-align: center;
            font-size: 14px;
            margin-top: 2px;
        }
        .navmenu a:hover,.navmenu .active{
            text-decoration: none;
            background: #007bff;
            color: #fff;
            animation: jello 1s;
            border-radius: 30px;
            border-top-left-radius: 0px;
        }
        .navmenu a i{
            font-size: 20px;
        }
        .bg-img{
            background-size: cover;
            z-index: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            opacity: .1;
            background-attachment: fixed;
            background-size: cover;
        }
        @media (max-width:600px){

            .navmenu a{
                width: 25%;
                padding: 16px 0;
            }
            .navmenu a span{
                display: none
            }
            .navmenu{
                position: fixed;
                z-index: 100;
                width: 100%;
                bottom: 0;
                left: 0;
            }
            .btn-logout{
                display: none
            }
        }

    </style>
    @yield("css-after")

</head>
<body>
    <img src="/login.png" class="bg-img" alt="bg">
    <div id="app">
        <nav class="navmenu">
                        @if(Auth::user())
                            <a class="@if(Request::is('home')) active  @endif)" href="/home">
                                <i class="fa fa-home"></i><br>
                                <span>Home</span>
                            </a>
                            <a class="@if(Request::is('admin/produk')) active  @endif)" href="/admin/produk">
                                <i class="fa fa-th-list"></i><br>
                                <span>Produk</span>
                            </a>
                            <a class="@if(Request::is('admin/transaksi')) active  @endif)" href="/admin/transaksi">
                                <i class="fa fa-shopping-cart "></i><br>
                                <span>Transaksi</span>
                            </a>
                            <a class="@if(Request::is('profile')) active  @endif)" href="#" >
                                    <i class="fa fa-user"></i><br>
                                    <span>{{ Auth::user()->name }}</span>
                            </a>
                            {{-- Logout --}}
                            <a class="btn-logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                   <i class="fa fa-arrow-right"></i><br>
                                    <span>{{ __('Logout') }}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    @yield('js-after')

</body>
</html>
