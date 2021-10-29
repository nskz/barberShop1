<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
{{--                        <h1 class="m-0">Edit Profile</h1>--}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">{{ Breadcrumbs::render('adminEditProfile') }}</li>
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
                    <!-- Input addon -->
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Edit Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">FN</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="FirstName" wire:model="data.firstName">
                                        @error('data.firstName')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">LN</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="LastName" wire:model="data.lastName">
                                        @error('data.lastName')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Email" wire:model="data.email">
                                        @error('data.email')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="PhoneNumber" wire:model="data.phoneNumber">
                                        @error('data.phoneNumber')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /input-group -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-success" wire:click="editInfo">Edit</button>
                                <button type="button" class="btn btn-default float-right" wire:click="cancelEditInfo">Cancel</button>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="New Password" wire:model="data.password">
                                        @error('data.password')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Confirm Password" wire:model="data.password_confirmation">
                                        @error('data.password_confirmation')
                                        <small>{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /input-group -->
                                @if(Session::has('message'))
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1 alert alert-danger">
                                            {{Session::get('message')}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-success" wire:click="editPass">Change</button>
                                <button type="button" class="btn btn-default float-right" wire:click="cancelEditPass">Cancel</button>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
