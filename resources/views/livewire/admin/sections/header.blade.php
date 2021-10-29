<div>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BarberShop | Dashboard</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/v4-shims.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href={{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}>
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/adminStyle.css')}}">

        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

        {{-- timepicker       --}}
        <script src="{{asset('js/timepicker.js')}}"></script>
        <link href="{{asset('css/timepicker.min.css')}}" rel="stylesheet"/>

        {{--        <script src="{{asset('js/app.js')}}"></script>--}}
        @livewireStyles
    </head>
</div>
@include('functions.functions')

<body class="hold-transition sidebar-mini layout-fixed">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('admin')}}" class="nav-link">HOME</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="{{url('logout')}}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> logout
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{url('admin/editProfile')}}" class="dropdown-item">
                    <i class="fas fa-edit"></i> edit profile
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">{{$newContactUs}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @php($i=1)
                @foreach($Contacts as $Contact)
                <a href="{{url('admin/ContactUs/'.$Contact->id)}}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
{{--                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <span style="padding-right: 5px" class="float-right text-sm text-danger"><i class="fa fa-eye"></i></span>
                                {{$Contact->nickname}}
                            </h3>
                            <p class="text-sm">{!! sub_text(50,$Contact->message); !!}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$Contact->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                    @php($i++)
                    <div class="dropdown-divider"></div>
                @endforeach
                <a href="{{url('admin/ContactUs')}}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                <i class="far fa-bell"></i>--}}
{{--                <span class="badge badge-warning navbar-badge">15</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                    <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                    <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                    <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
{{--            </div>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="BarberShop Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BarberShop Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/default.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$fullName}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('admin')}}" class="nav-link {{ Request::segment(2) === null ? 'active' : null }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'UsersManagement' ? 'menu-open' : null }}">
                    <a href="#" class="nav-link {{ Request::segment(2) === 'UsersManagement' ? 'active' : null }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/UsersManagement/usersList')}}" class="nav-link {{ Request::segment(3) === 'usersList' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/UsersManagement/userGroupsList')}}" class="nav-link {{ Request::segment(3) === 'userGroupsList' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>UserGroups</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'Contents' ? 'menu-open' : null }}">
                    <a href="#" class="nav-link {{ Request::segment(2) === 'Contents' ? 'active' : null }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Contents
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/Contents/textsList')}}" class="nav-link {{ Request::segment(3) === 'textsList' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Texts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/Contents/slidersList')}}" class="nav-link {{ Request::segment(3) === 'slidersList' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'Settings' ? 'menu-open' : null }}">
                    <a href="#" class="nav-link {{ Request::segment(2) === 'Settings' ? 'active' : null }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/Settings/Prepaid')}}" class="nav-link {{ Request::segment(3) === 'Prepaid' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Prepaid</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/Settings/BookingStatuses')}}" class="nav-link {{ Request::segment(3) === 'BookingStatuses' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Booking Statuses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/Settings/BarbersList')}}" class="nav-link {{ Request::segment(3) === 'BarbersList' ? 'active' : null }}">
                                <i class="far fa-square nav-icon"></i>
                                <p>Barbers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/Reservations')}}" class="nav-link {{ Request::segment(2) === 'Reservations' ? 'active' : null }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Reservations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/FinanceInfo')}}" class="nav-link {{ Request::segment(2) === 'FinanceInfo' ? 'active' : null }}">
                        <i class="nav-icon fa fa-money"></i>
                        <p>
                            Finance Info
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
