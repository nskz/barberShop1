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
                                            <div wire:ignore class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                    <select class="form-control select2" id="select2" multiple="multiple" wire:model="workDays" data-placeholder="Select ...">
                                                        @foreach($weekDays as $weekDay)
                                                            <option value="{{$weekDay->id}}">{{$weekDay->title}}</option>
                                                        @endforeach
                                                    </select>
                                                <small id="error"></small>
                                                <script>
                                                    window.livewire.on('message',function (message) {
                                                        document.getElementById("error").innerHTML = message;
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Hours of work ( From )</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input wire:model="startWorkTime" class="form-control" type="text" id="startTime" placeholder="Start Time" ng-model="from">
                                                    @error('startWorkTime')
                                                    <small>{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Hours of work ( To )</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    </div>
                                                    <input wire:model="endWorkTime" class="form-control" type="text" id="endTime" placeholder="End Time" ng-model="to">
                                                    @error('endWorkTime')
                                                    <small>{{$message}}</small>
                                                    @enderror
                                                </div>
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

                                                    var times = {}; // Added to initialize an object

                                                    var timepicker = new TimePicker(['startTime', 'endTime'], {
                                                        theme: 'dark',
                                                        lang: 'en',
                                                        stepping:30
                                                    });

                                                    timepicker.on('change', function(evt){
                                                        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
                                                        evt.element.value = value;

                                                        //Added the below to store in the object and consoling:
                                                        var id = evt.element.id;
                                                        times[id] = value;
                                                        if (id=='startTime'){
                                                            @this.set('startWorkTime', value);
                                                        }else{
                                                            @this.set('endWorkTime', value);
                                                        }
                                                        console.clear();
                                                        // console.log(times); // Display the object
                                                    });
                                                });

                                            </script>
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
                                <div class="col-md-6 col-md-push-3">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Barber</h3>
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
                                                <div wire:ignore class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <select class="form-control select2" id="select2" multiple="multiple" wire:model="workDays" data-placeholder="{{$currentDay}}">
                                                        @foreach($weekDays as $weekDay)
                                                            <option value="{{$weekDay->id}}">{{$weekDay->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="error"></small>
                                                    <script>
                                                        window.livewire.on('message',function (message) {
                                                            document.getElementById("error").innerHTML = message;
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Hours of work ( From )</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                        </div>
                                                        <input wire:model="startWorkTime" class="form-control" type="text" id="startTime" placeholder="Start Time" ng-model="from">
                                                        @error('startWorkTime')
                                                        <small>{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Hours of work ( To )</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                        </div>
                                                        <input wire:model="endWorkTime" class="form-control" type="text" id="endTime" placeholder="End Time" ng-model="to">
                                                        @error('endWorkTime')
                                                        <small>{{$message}}</small>
                                                        @enderror
                                                    </div>
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

                                                    var times = {}; // Added to initialize an object

                                                    var timepicker = new TimePicker(['startTime', 'endTime'], {
                                                        theme: 'dark',
                                                        lang: 'en',
                                                        stepping:30
                                                    });

                                                    timepicker.on('change', function(evt){
                                                        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
                                                        evt.element.value = value;

                                                        //Added the below to store in the object and consoling:
                                                        var id = evt.element.id;
                                                        times[id] = value;
                                                        if (id=='startTime'){
                                                        @this.set('startWorkTime', value);
                                                        }else{
                                                        @this.set('endWorkTime', value);
                                                        }
                                                        console.clear();
                                                        // console.log(times); // Display the object
                                                    });
                                                });

                                            </script>
                                            <!-- /input-group -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-success" wire:click="updateBarber">Edit Barber</button>
                                            <button type="button" class="btn btn-default float-right" wire:click="cancelEditBarber">Cancel</button>
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


