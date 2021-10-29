<div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('admin') }}</li>
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$reservations}}</h3>
                                    <p>Reservations</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <a href="{{url('admin/Reservations')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$users}}</h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="{{url('admin/UsersManagement/usersList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{$barbers}}</h3>
                                    <p>Barbers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-scissors"></i>
                                </div>
                                <a href="{{url('admin/Settings/BarbersList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$messages}}</h3>

                                    <p>messages</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-comment"></i>
                                </div>
                                <a href="{{url('admin/ContactUs')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-10 col-md-push-1">
                            <div class="card card-default with-top-border">
                                <div class="card-header">
                                    <h2 class="card-title" style="font-weight: bold">Reservations List</h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Num</th>
                                            <th>Customer Name</th>
                                            <th>Phone Number</th>
                                            <th>Booking Code</th>
                                            <th>Barber Name</th>
                                            <th>Created at</th>
                                            <th>Booking Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($ReservationList as $value)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$value->customerName ." ".$value->customerFamily}}</td>
                                                <td>{{$value->customerPhoneNumber}}</td>
                                                <td>{{$value->reserveCode}}</td>
                                                <td>{{$value->barberName ." ".$value->barberFamily}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->created_at))}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->date))}}</td>
                                                <td>{{$value->statusTitle}}</td>
                                                <td><a href="{{url('admin/Reservations/'.$value->id)}}"><i class="fa fa-eye text-primary" title="Details"></i> </a>
                                                </td>
                                            </tr>
                                            @php($i++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <a style="font-weight: bold" href="{{url('admin/Reservations')}}">More <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
</div>
