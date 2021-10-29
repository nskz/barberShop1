<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if($isListPage==1)
                            <a wire:click="addNewGroup" class="btn btn-primary m-0">Add New Group <i class="fa fa-plus"></i></a>
                        @else
                            <a wire:click="returnToListPage" class="btn btn-primary m-0"><i class="fa fa-arrow-left"></i> Return</a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @if($isListPage==1)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('userGroupsList') }}</li>
                            @elseif($isListPage==2)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('AddNewGroup') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('EditGroup') }}</li>
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
                                    <h3 class="card-title text-bold">UserGroupsList</h3>

                                    {{--                                <div class="card-tools">--}}
                                    {{--                                    <div class="input-group input-group-sm" style="width: 150px;">--}}
                                    {{--                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">--}}

                                    {{--                                        <div class="input-group-append">--}}
                                    {{--                                            <button type="submit" class="btn btn-default">--}}
                                    {{--                                                <i class="fas fa-search"></i>--}}
                                    {{--                                            </button>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Num</th>
                                            <th>Title</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($userGroups as $userGroup)
                                            @if($userGroup->status==1)
                                                @php($status='active')
                                            @else
                                                @php($status='inactive')
                                            @endif
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$userGroup->title}}</td>
                                                <td>{{$userGroup->level}}</td>
                                                <td style="cursor: pointer"><span @if($userGroup->status==1) class="text-success" @else class="text-danger" @endif wire:click="changeGroupStatus({{$userGroup->id}},{{$userGroup->status}})">{{$status}} <i @if($userGroup->status==1) class="fa fa-check" @else class="fa fa-ban" @endif></i></span></td>
                                                <td><a wire:click="editGroup({{$userGroup->id}})"><i class="fa fa-edit text-primary" title="edit"></i> </a>
                                                    <a wire:click="$emit('showDeleteAlert',{{$userGroup->id}})"><i class="fa fa-trash text-danger" title="delete"></i> </a>
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
                                {{$userGroups->links()}}
                            </div>
                        @elseif($isListPage==2)
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New Group</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">T</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Title" wire:model="title">
                                                @error('title')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Level</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">L</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Level" wire:model="level">
                                                @error('level')
                                                <small>{{$message}}</small>
                                                @enderror
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
                                        <button type="button" class="btn btn-success" wire:click="insertGroup">Add Group</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelAddGroup">Cancel</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Group</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">T</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Title" wire:model="title">
                                                @error('title')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Level</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">L</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Level" wire:model="level">
                                                @error('level')
                                                <small>{{$message}}</small>
                                                @enderror
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
                                        <button type="button" class="btn btn-success" wire:click="updateGroup">Edit Group</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelEditGroup">Cancel</button>
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
