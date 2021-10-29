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
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('Prepaid') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('EditPrepaid') }}</li>
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
                            <div class="card col-md-6 col-md-push-3">
                                <div class="card-header">
                                    <h3 class="card-title text-bold">Prepaid Price</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        @php($i=1)
                                        <tr>
                                            <th>Num</th>
                                            <th>Price</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{number_format($value->price) ." "."$"}}</td>
                                                <td><a wire:click="editPrepaid({{$value->id}})"><i class="fa fa-edit text-primary" title="edit"></i> </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="clearfix">
                            </div>
                        @else
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Prepaid Price</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="Price" wire:model="price">
                                                @error('price')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" wire:click="updatePrepaid">Edit Prepaid</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelEditPrepaid">Cancel</button>
                                    </div>
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

