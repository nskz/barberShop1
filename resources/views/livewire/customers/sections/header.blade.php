<div>
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('customers/assets/img/apple-icon.png')}}">
        <link rel="icon" type="image/png" href="{{asset('customers/assets/img/favicon.png')}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            BarberShop | Dashboard
        </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/v4-shims.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

        <!-- CSS Files -->
        <link href="{{asset('customers/assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="{{asset('customers/assets/demo/demo.css')}}" rel="stylesheet" />
        @livewireStyles
    </head>
</div>
<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('customers/assets/img/sidebar-1.jpg')}}">
        <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
               {{auth()->user()->firstName ." ".auth()->user()->lastName}}
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item {{ Request::segment(2) === null ? 'active' : null }}">
                    <a class="nav-link" href="{{url('UserPanel')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./user.html">
                        <i class="material-icons">person</i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('logout')}}">
                        <i class="fa fa-sign-out"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

