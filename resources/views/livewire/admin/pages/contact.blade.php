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
                            @if($isListPage==1)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('ContactUs') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('Details') }}</li>
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
                                    <h3 class="card-title text-bold">Contact Us List</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input  wire:model.debounce.100ms="char" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <span class="btn btn-default" style="cursor: default">
                                                    <i class="fas fa-search"></i>
                                                </span>
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
                                            <th>Subject</th>
                                            <th>Nickname</th>
                                            <th>PhoneNumber</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($values as $value)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$value->subject}}</td>
                                                <td>{{$value->nickname}}</td>
                                                <td>{{$value->phoneNumber}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>{!! sub_text(50,$value->message) !!}</td>
                                                <td>{{$value->status}}</td>
                                                <td><a wire:click="details({{$value->id}})"><i class="fa fa-eye text-primary" title="Details"></i> </a>
                                                    <a wire:click="$emit('showDeleteContactAlert',{{$value->id}})"><i class="fa fa-trash text-danger" title="delete"></i> </a>
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
                            <div class="col-md-10 col-md-push-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Details</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="responsive table table-striped table-bordered table-hover">
                                            <tbody class="contactUs">
                                               @php($statusTitle='read')
                                               <tr>
                                                   <th>Created at</th>
                                                   <td>{{$created_at->diffForHumans()}}</td>
                                               </tr>
                                               <tr>
                                                    <th>Subject</th>
                                                    <td>{{$subject}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Nickname</th>
                                                   <td>{{$nickname}}</td>
                                               </tr>
                                               <tr>
                                                   <th>PhoneNumber</th>
                                                   <td>{{$phoneNumber}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Email</th>
                                                   <td>{{$email}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Message</th>
                                                   <td colspan="4">{{$message}}</td>
                                               </tr>
                                            </tbody>
                                        </table>
                                    </div>                                    <!-- /.card-body -->
                                    <!-- /.card-footer -->
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
