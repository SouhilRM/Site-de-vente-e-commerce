@extends('admin.admin_master')
@section('admin')

<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
<div class="container-full">
<section class="content">
<div class="row">
<div class="col-12">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit a Slider</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
        <form method="POST" action="{{ route('update.slider') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $slider->id }}" name="id">
            <div class="form-group">
                <h5>Title <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input id="current_password" type="text" name="title" value="{{ old('title')? old('title') : $slider->title }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <h5>Description <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input id="current_password" type="text" name="description" value="{{ old('description')? old('description') : $slider->description }}" class="form-control">
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
                <img id="showImage" height="270px" src="{{ asset($slider->slider_img) }}" width="670px" alt="">
            </div>
                
            <div class="form-group">
                <button type="submit" class="btn btn-rounded btn-success">EDIT</button>
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