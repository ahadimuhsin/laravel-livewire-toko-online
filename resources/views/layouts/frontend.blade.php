<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Console</title>
    <link rel="shortcut icon" href="{{ asset('images/basket.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Asset Turbolink --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- Asset Livewire --}}
    <livewire:styles />
    <livewire:scripts />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"
        integrity="sha512-g2PN+aYR0KupTVwea5Ppqw4bxWLLypWdd+h7E0ydT8zF+/Y2Qpk8Y1SnzVw6ZCVJPrgB/91s3VfhVhP7Y4+ucw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- Asset Turbolink --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #e2e8f0;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #171d26 !important">
        <a class="navbar-brand font-weight-bold" href="#">
            <i class="fa fa-carrot"></i> SK STORE
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarExampleDefault"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbar-sk">
            {{-- Kategori --}}
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-list-ul"></i> Kategori
                    </a>
                    <div class="dropdown-menu border-0 shadow-sm dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink">
                    @foreach($global_categories as $category)
                        <a href="/category/{{ $category->slug }}" class="dropdwon-item">
                            <img src="{{ Storage::url('public/categories/'.$category->image) }}"
                            class="rounded" style="width: 20px">
                            {{ $category->name }}
                        </a>
                    @endforeach
                    </div>
                </li>
            </ul>

            {{-- Search --}}
            <div class="mx-2 my-auto" style="width: 45%">
                <form action="{{route('search')}}">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0"
                        placeholder="Search..." name="q">
                        <span class="input-group-append">
                            <button class="btn text-dark border border-left-0"
                            style="background-color: white" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>

            <ul class="nav navbar-nav navbar-right ml-auto">
                {{-- Cart --}}
                <livewire:frontend.cart.header>

                @if(Auth::guard('customer')->check())
                <ul class="navbar-nav d-none d-md-block ml-4">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle font-weight-bold"
                        id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i>
                        {{ Auth::guard('customer')->user()->name }}
                    </a>
                    <div class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdwon">
                        <a href="{{ url('customer/dashboard') }}" class="dropdown-item">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ url('customer/orders') }}">
                            <i class="fa fa-shopping-cart"></i> My Orders
                        </a>

                        <div class="dropdown-divider"></div>
                            <livewire:customer.auth.logout>

                            </livewire:customer.auth.logout>
                    </div>
                    </li>
                </ul>
                @else
                <li class="nav-item">
                    <a href="{{ url('customer/login') }}"
                    class="btn btn-md shadow btn-outline-dark
                    btn-block" style="color: #fff; background-color: #343a40; border-color: #343a40">
                    <i class="fa fa-user-circle"></i> Account
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    @if(Auth::guard('customer')->check() && request()->segment(1) == "customer")
    <div class="jumbotron rounded-0" style="background-color: #566479; padding-bottom: 8rem">
        <div class="container">

        </div>
    </div>
    @endif

    <div class="container-fluid mb-5">
        @yield('content')
    </div>

    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}')
        @elseif(session()->has('error'))
            toatsr.error('{{ session('error') }}')
        @endif

        window.livewire.on('alert', param => {
            toastr[param['type']](param['message']);
            toastr.options.preventDuplicates = true;
        });
    </script>

</body>
</html>
