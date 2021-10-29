<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if($isListPage!=1)
                            <a wire:click="returnToListPage" class="btn btn-primary m-0"><i class="fa fa-arrow-left"></i> Return</a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @if($isListPage==1)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('ReservationsList') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('ReserveDetails') }}</li>
                            @endif
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
                    <div class="col-12">
                        @if($isListPage==1)
                            <div class="card">
                                <div class="card-header">
{{--                                    <h3 class="card-title text-bold">ReservationsList</h3>--}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Search Words:</label>
                                                        <div class="form-control input-group input-group-sm" style="padding: unset;padding-top: 0.17rem">
                                                            <input style="border: none"  wire:model.debounce.100ms="char" type="text" name="table_search" class="form-control" placeholder="Search">
                                                            <i class="fas fa-search" style="padding: .5rem .75rem;color: black"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Search Status:</label>
                                                        <select class="form-control" wire:model="status">
                                                            <option value="">Select status</option>
                                                            @foreach($statuses as $status)
                                                                <option value="{{$status->id}}">{{$status->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Search Booking Date:</label>
                                                        <input wire:model.debounce.100ms="bookingDate" type="date" name="table_search" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                        @foreach($values as $value)
                                            <?php
                                            $prepayment=\App\Models\Wallet::where(['userId'=>$value->userId,'reservationId'=>$value->id,'typeId'=>0,'reasonId'=>1,'status'=>1])->count();
                                            $return=\App\Models\Wallet::where(['userId'=>$value->userId,'reservationId'=>$value->id,'typeId'=>1,'reasonId'=>2,'status'=>1])->count();
                                            ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$value->customerName ." ".$value->customerFamily}}</td>
                                                <td>{{$value->customerPhoneNumber}}</td>
                                                <td>{{$value->reserveCode}}</td>
                                                <td>{{$value->barberName ." ".$value->barberFamily}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->created_at))}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->date))}}</td>
                                                <td style="cursor: pointer">
                                                    <select class="form-control" wire:change="changeStatus({{$value->id}},$event.target.value)">
                                                        @foreach($statuses as $status)
                                                            <option {{$status->id == $value->status? 'selected' : ''}} value="{{$status->id}}">{{$status->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><a wire:click="details({{$value->id}})"><i class="fa fa-eye text-primary" title="Details"></i> </a>
                                                    @if($prepayment==1 && $return==0)
                                                    <a wire:click="$emit('showReturnPrepaymentAlert',{{$value->id}})"><i class="fa fa-money-check text-danger" title="Return Prepayment"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php($i++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="clearfix">
                                {{$values->links()}}
                            </div>
                        @else
                            <?php
                            $prepayment=\App\Models\Wallet::where(['userId'=>$customerId,'reservationId'=>$bookingId,'typeId'=>0,'reasonId'=>1,'status'=>1])->count();
                            $return=\App\Models\Wallet::where(['userId'=>$customerId,'reservationId'=>$bookingId,'typeId'=>1,'reasonId'=>2,'status'=>1])->count();
                            ?>
                            <div class="row">
                                <div class="col-md-5 col-md-push-1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Details</h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="responsive table table-striped table-bordered table-hover">
                                                <tbody class="reservations-table">
                                                <tr>
                                                    <th>Created at</th>
                                                    <td>{{date('d/m/Y', strtotime($created_at))}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Booking DateTime</th>
                                                    <td>{{date('d/m/Y', strtotime($Bdate)) .'  '.$Btime}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <td>{{$customerName}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td>{{$phoneNumber}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Barber Name</th>
                                                    <td>{{$barberName}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Booking Code</th>
                                                    <td>{{$bookingCode}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-push-1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Actions</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Change Status</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">S</span>
                                                    </div>
                                                    <select class="form-control" wire:change="changeStatus({{$bookingId}},$event.target.value)">
                                                        @foreach($statuses as $status)
                                                            <option {{$status->id == $Bstatus? 'selected' : ''}} value="{{$status->id}}">{{$status->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if($prepayment==1 && $return==0)
                                                <hr><hr>
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <a class="btn btn-danger" wire:click="$emit('showReturnPrepaymentAlert',{{$bookingId}})">Return Prepayment <i class="fa fa-money-check" title="Return Prepayment"></i> </a>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- /input-group -->
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
