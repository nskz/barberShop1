@include('functions.functions')
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
                            <li class="breadcrumb-item active">{{ Breadcrumbs::render('transactionsList') }}</li>
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
                                    <div class="row">
                                        <h3 class="col-md-3 card-title text-bold">Transactions List</h3>
                                        <div class="col-md-3 col-md-push-6" style="text-align: end">
                                                <span style="color: green;font-weight: 600;font-size: large;text-shadow: 1px 1px 2px;">
                                                    {{'Total : '.$total .' $'}}
                                                </span>
                                        </div>

                                    </div><br>
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
                                                        <label>Search Date:</label>
                                                        <input wire:model.debounce.100ms="Date" type="date" name="table_search" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Search Transaction Type:</label>
                                                        <select class="form-control" wire:model="type">
                                                            <option value="">Select transaction type</option>
                                                            <option value="0">Withdraw</option>
                                                            <option value="1">Deposit</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Search Reason:</label>
                                                        <select class="form-control" wire:model="reason">
                                                            <option value="">Select reason</option>
                                                            @foreach($reasons as $reason)
                                                                <option value="{{$reason->id}}">{{$reason->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Num</th>
                                            <th>Name</th>
                                            <th>Tracking Code</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($wallets as $wallet)
                                            @if($wallet->typeId==0)
                                                @php($type='withdraw')
                                            @else
                                                @php($type='deposit')
                                            @endif
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$wallet->firstName .' '.$wallet->lastName}}</td>
                                                <td>{{$wallet->trackingCode}}</td>
                                                <td>{{number_format($wallet->price)}}</td>
                                                <td>{{$type}}</td>
                                                <td>{{$wallet->reason}}</td>
                                                <td>{{date('d/m/Y', strtotime($wallet->created_at))}}</td>
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
                                {{$wallets->links()}}
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
