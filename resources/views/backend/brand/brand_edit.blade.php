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
                         <h3 class="box-title">Add New Brand</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('update.brand') }}" enctype="multipart/form-data">
                                    @csrf
                                          
                                    <input type="hidden" name="id" value="{{ $brand->id }}">

                                    <div class="form-group">
                                        <h5>Brand Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $brand->brand_name_en }}" type="text" name="brand_name_en" class="form-control">
                                            @error('brand_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $brand->brand_name_fr }}" type="text" name="brand_name_fr" class="form-control">
                                            @error('brand_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="brand_image" class="form-control">
                                        </div>
                                            @error('brand_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <img id="showImage" src="{{ asset($brand->brand_image) }}" height="130px" width="auto" alt="">
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