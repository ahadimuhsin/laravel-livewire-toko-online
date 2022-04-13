<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Console</title>
    <link rel="shortcut icon" href="{{ asset('images/basket.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #e2e8f0;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"
    style="background-color: #171d26!important">
        <a class="navbar-brand font-weight-bold" href="{{ route('dashboard') }}">
            <i class="fa fa-carrot"></i> SK STORE
        </a>

        <button class="navbar-toggler" type="button"
        data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto text-uppercase">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fa fa-chart-line">
                    </i>Analytic
                </a>

                </li>
                <li class=" nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-bag"></i> Products</a>

                    <div class="dropdown-menu shadow border-0" aria- labelledby="dropdown01">

                        <a class="dropdown-item" href="{{ route('categories.index') }}"><i class="fa fa-folder"></i> Categories</a>

                        <a class="dropdown-item" href="{{ route('products.index') }}"><i class="fa fa-shopping-bag"></i> Data Products</a>

                        <a class="dropdown-item" href="{{ route('vouchers.index') }}"><i class="fa fa-award"></i> Voucher</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fa

                    fa-shopping-cart"></i> Orders</a>

                    <div class="dropdown-menu shadow border-0" aria- labelledby="dropdown01">

                        <a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fa fa-shopping-cart"></i> Data Orders</a>

                        <a class="dropdown-item" href="{{ route('payments.index') }}"><i class="fa fa-credit-card"></i> Payment Confirmation</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sliders.index') }}"><i class="fa fa-laptop"></i>

                        Sliders</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-users"></i>Users</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 0px">
                <li class="dropdown">
                    <a class="dropdown-toggle text-white" style="padding-top: 13px;line-height: 30px;padding-bottom:9px;text-decoration: none;"
                    data-toggle="dropdown" href="#"><i class="fa fa-user-circle">
                        </i> {{ auth()->user()->name }}

                        <span class="caret"></span></a>

                    <div class="dropdown-menu shadow border-0" aria- labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="{{ url('/') }}" target="_blank"><i
                                class="fa fa-external-link-alt"></i> View Site</a>

                        <div class="dropdown-divider"></div>
                        <livewire:console.logout />
                    </div>
            </ul>
        </div>
    </nav>

    <div class="jumbotron rounded-0" style="background-color: #566479; padding-bottom: 8rem">
        <div class="container">
        </div>
    </div>

    <div class="container-fluid mb-5" style="margin-top: -120px">
        @yield('content')
    </div>

    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}')
        @elseif(session()->has('error'))
            toatsr.error('{{ session('error') }}')
        @endif

    </script>
</body>

</html>
