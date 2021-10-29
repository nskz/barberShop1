@include('functions.functions')
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if($isListPage==1)
                            <a wire:click="addNewBarber" class="btn btn-primary m-0">Add New Barber <i class="fa fa-plus"></i></a>
                        @else
                            <a wire:click="returnToListPage" class="btn btn-primary m-0"><i class="fa fa-arrow-left"></i> Return</a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @if($isListPage==1)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('BarbersList') }}</li>
                            @elseif($isListPage==2)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('AddNewBarber') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('EditBarber') }}</li>
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
                                    <h3 class="card-title text-bold">BarbersList</h3>
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
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($barbers as $barber)
                                            @if($barber->status==1)
                                                @php($status='active')
                                            @else
                                                @php($status='inactive')
                                            @endif
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$barber->firstName ." ".$barber->lastName}}</td>
                                                <td>{{$barber->phoneNumber}}</td>
                                                <td>{{$barber->email}}</td>
                                                <td><?php sub_text(50,$barber->address); ?></td>
                                                <td style="cursor: pointer"><span @if($barber->status==1) class="text-success" @else class="text-danger" @endif wire:click="changeBarberStatus({{$barber->id}},{{$barber->status}})">{{$status}} <i @if($barber->status==1) class="fa fa-check" @else class="fa fa-ban" @endif></i></span></td>
                                                <td><a wire:click="editBarber({{$barber->id}})"><i class="fa fa-edit text-primary" title="edit"></i> </a>
                                                    <a wire:click="$emit('showDeleteBarberAlert',{{$barber->id}})"><i class="fa fa-trash text-danger" title="delete"></i> </a>
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
                                {{$barbers->links()}}
                            </div>
                        @elseif($isListPage==2)
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New Barber</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">F</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="FirstName" wire:model="firstName">
                                                @error('firstName')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">L</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="LastName" wire:model="lastName">
                                                @error('lastName')
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
                                                <input type="text" class="form-control" placeholder="Email" wire:model="email">
                                                @error('email')
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
                                                <input type="text" class="form-control" placeholder="PhoneNumber" wire:model="phoneNumber">
                                                @error('phoneNumber')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                                </div>
                                                <textarea class="form-control" wire:model="address" placeholder="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Days of work</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <div wire:ignore>
                                                    <select class="select2" id="select2" multiple="multiple" wire:model="workDays" data-placeholder="Select ..." >
                                                        <option value="1">Sunday</option>
                                                        <option value="2">Monday</option>
                                                        <option value="3">Tuesday</option>
                                                        <option value="4">Wednesday</option>
                                                        <option value="5">Thursday</option>
                                                        <option value="6">Friday</option>
                                                        <option value="7">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hours of work</label>
                                            <div class="input-group mb-3 date" id="timepicker" data-target-input="nearest">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input wire:model="workTime" type="text" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker" autocomplete="off"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">S</span>
                                                </div>
                                                <select name="status" class="form-control" wire:model="status">
                                                    <option value="none" disabled>choose status</option>
                                                    <option value="0">inactive</option>
                                                    <option value="1" selected>active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" wire:click="insertBarber">Add Barber</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelAddBarber">Cancel</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-5 col-md-push-1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit User Info</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">F</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="FirstName" wire:model="firstName">
                                                    @error('firstName')
                                                    <small>{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">L</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="LastName" wire:model="lastName">
                                                    @error('lastName')
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
                                                    <input type="text" class="form-control" placeholder="Email" wire:model="email">
                                                    @error('email')
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
                                                    <input type="text" class="form-control" placeholder="PhoneNumber" wire:model="phoneNumber">
                                                    @error('phoneNumber')
                                                    <small>{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Role</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">R</span>
                                                    </div>
                                                    <select name="groupId" class="form-control" wire:model="groupId">
                                                        <option value="none" disabled>choose role</option>
                                                        @foreach($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">S</span>
                                                    </div>
                                                    <select name="status" class="form-control" wire:model="status">
                                                        <option value="none" disabled>choose status</option>
                                                        <option value="0">inactive</option>
                                                        <option value="1" selected>active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-success" wire:click="updateUser">Edit User</button>
                                            <button type="button" class="btn btn-default float-right" wire:click="cancelEditUser">Cancel</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-push-1">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Password</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="NewPassword" wire:model="newPassword">
                                                    @error('newPassword')
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
                                                    <input type="text" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="PasswordConfirmation" wire:model="new_password_confirmation">
                                                </div>
                                            </div>
                                            <!-- /input-group -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-success" wire:click="editPass">Edit Password</button>
                                            <button type="button" class="btn btn-default float-right" wire:click="cancelEditPass">Cancel</button>
                                        </div>
                                        <!-- /.card-footer -->
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
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#select2").select2();
            $('#select2').select2({
                theme: 'bootstrap4'
            });
            $('#select2').on('change', function (e) {
                let data = $(this).val();
            @this.set('workDays', data);
            });
            window.livewire.on('resetAddBarber', () => {
                $('#select2').select2();
            });
        });
        $(function () {
            //Timepicker
            $('#timepicker').datetimepicker({
                datepicker : false,
                // format : 'LT',
                format : 'HH:mm',
                stepping: 30
            })
        })
    </script>
@endpush

