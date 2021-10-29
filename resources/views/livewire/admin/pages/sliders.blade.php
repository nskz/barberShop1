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
                            <a wire:click="addNewSlider" class="btn btn-primary m-0">Add New Slider <i class="fa fa-plus"></i></a>
                        @else
                            <a wire:click="returnToListPage" class="btn btn-primary m-0"><i class="fa fa-arrow-left"></i> Return</a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @if($isListPage==1)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('SlidersList') }}</li>
                            @elseif($isListPage==2)
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('AddNewSlider') }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ Breadcrumbs::render('EditSlider') }}</li>
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
                                    <h3 class="card-title text-bold">SlidersList</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Num</th>
                                            <th>Title</th>
                                            <th>Picture</th>
                                            <th>Link</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($sliders as $slider)
                                            @if($slider->status==1)
                                                @php($status='active')
                                            @else
                                                @php($status='inactive')
                                            @endif
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$slider->title}}</td>
                                                <td><img src="{{asset($slider->name)}}" alt="" title="" style="max-height: 55px; width: auto"></td>
                                                <td>{{$slider->link}}</td>
                                                <td><?php sub_text(50,$slider->description); ?></td>
                                                <td style="cursor: pointer"><span @if($slider->status==1) class="text-success" @else class="text-danger" @endif wire:click="changeSliderStatus({{$slider->id}},{{$slider->status}})">{{$status}} <i @if($slider->status==1) class="fa fa-check" @else class="fa fa-ban" @endif></i></span></td>
                                                <td><a wire:click="editSlider({{$slider->id}})"><i class="fa fa-edit text-primary" title="edit"></i> </a>
                                                    <a wire:click="$emit('showDeleteSliderAlert',{{$slider->id}})"><i class="fa fa-trash text-danger" title="delete"></i> </a>
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
                                {{$sliders->links()}}
                            </div>
                        @elseif($isListPage==2)
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New Slider</h3>
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
                                            <label for="">Link</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Link" wire:model="link">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">D</span>
                                                </div>
                                                <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
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
                                        <div class="form-group">
                                            <label for="">Picture</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" style="height: unset;padding: unset" class="form-control file-input" wire:model="picture">
                                                </div>
                                                @error('picture')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" wire:click="insertSlider">Add Slider</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelAddSlider">Cancel</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 col-md-push-3">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Slider</h3>
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
                                            <label for="">Link</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Link" wire:model="link">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">D</span>
                                                </div>
                                                <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
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
                                        <div class="form-group">
                                            <label for="">Picture</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" style="height: unset;padding: unset" class="form-control file-input" wire:model="picture">
                                                </div>
                                                @error('picture')
                                                <small>{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" wire:click="updateSlider">Edit Slider</button>
                                        <button type="button" class="btn btn-default float-right" wire:click="cancelEditSlider">Cancel</button>
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
