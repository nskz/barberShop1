    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid" style="margin: 0 10px;border-bottom: 1px solid #d4d4d4">
                <div class="navbar-wrapper">
                    <span class="navbar-brand" href="javascript:;" style="line-height: unset;padding: unset;">{{ Breadcrumbs::render('userPanel') }}</span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
{{--                    <form class="navbar-form">--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <button type="submit" class="btn btn-white btn-round btn-just-icon">--}}
{{--                                <i class="material-icons">search</i>--}}
{{--                                <div class="ripple-container"></div>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <ul class="navbar-nav">
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="javascript:;">--}}
{{--                                <i class="material-icons">dashboard</i>--}}
{{--                                <p class="d-lg-none d-md-block">--}}
{{--                                    Stats--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="material-icons">notifications</i>--}}
{{--                                <span class="notification">5</span>--}}
{{--                                <p class="d-lg-none d-md-block">--}}
{{--                                    Some Actions--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                <a class="dropdown-item" href="#">Mike John responded to your email</a>--}}
{{--                                <a class="dropdown-item" href="#">You have 5 new tasks</a>--}}
{{--                                <a class="dropdown-item" href="#">You're now friend with Andrew</a>--}}
{{--                                <a class="dropdown-item" href="#">Another Notification</a>--}}
{{--                                <a class="dropdown-item" href="#">Another One</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons" style="font-size: xx-large">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('logout')}}">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-push-2">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">store</i>
                                </div>
                                <p class="card-category">Reservations</p>
                                <h3 class="card-title">{{$reservations}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="{{url('userPanel/Reservations')}}" class="small-box-footer">More info <i class="fa fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-md-push-2">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <p class="card-category">Balance</p>
                                <h3 class="card-title">{{number_format($balance) .' '.'$'}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="{{url('userPanel/Wallet')}}" class="small-box-footer">More info <i class="fa fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
