@extends('admin.admin_master')
@section('admin')

<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
<div class="container-full">
<section class="content">
<div class="row">
<div class="col-8">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Sliders Liste</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Slider</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($slider as $item)
            <tr>
                
                <td><img src="{{ asset($item->slider_img) }}" alt="" height="100px" width="100px"></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td class="text-center">
                    @if($item->status)
                        <span class="badge badge-pill badge-success"> Active </span>
                    @else
                        <span class="badge badge-pill badge-danger"> InActive </span>
                    @endif
                </td>
                <td> 
                    <a href="{{ route('edit.slider',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>

                    <a href="{{ route('delete.slider',$item->id) }}" class="btn btn-warning sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
                    
                    @if($item->status)
                    <a href="{{ route('inactive.slider',$item->id) }}" class="btn btn-danger float-right" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                    @else
                    <a href="{{ route('active.slider',$item->id) }}" class="btn btn-success float-right" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->           
</div>

<div class="col-4">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Add New Slider</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
        <form method="POST" action="{{ route('store.slider') }}" enctype="multipart/form-data">
            @csrf
                    
            <div class="form-group">
                <h5>Title <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input id="current_password" type="text" name="title" value="{{ old('title') }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <h5>Description <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input id="current_password" type="text" name="description" value="{{ old('description') }}" class="form-control">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <h5>Slider Image <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="file" id="image" name="slider_img" value="{{ old('slider_img') }}" class="form-control">
                </div>
                    @error('slider_img')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>

            <div class="form-group">
                <img id="showImage" height="130px" width="auto" alt="">
            </div>
                
            <div class="form-group">
                <button type="submit" class="btn btn-rounded btn-success">ADD</button>
            </div>
        </form>
    </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->          
</div>
</div>
    
</section>
</div>
</div>

<!--script concernant le chargement de limage apres l'upload-->
<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection