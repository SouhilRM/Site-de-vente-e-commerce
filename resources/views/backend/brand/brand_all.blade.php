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
                         <h3 class="box-title">Brands Liste</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                   <tr>
                                       <th>Brand En</th>
                                       <th>Brand En</th>
                                       <th>Image</th>
                                       <th>Actions</th>
                                       
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brand as $item)
                                    <tr>
                                        <td>{{ $item->brand_name_en }}</td>
                                        <td>{{ $item->brand_name_fr }}</td>
                                        <td><img src="{{ asset($item->brand_image) }}" alt="" height="100px" width="auto"></td>
                                        <td>
                                            <a href="{{ route('edit.brand',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>
    
                                            <a href="{{ route('delete.brand',$item->id) }}" class="btn btn-danger sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
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
                         <h3 class="box-title">Add New Brand</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                                    @csrf
                                          
                                    <div class="form-group">
                                        <h5>Brand Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="brand_name_en" value="{{ old('brand_name_en') }}" class="form-control">
                                            @error('brand_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="brand_name_fr" value="{{ old('brand_name_fr') }}" class="form-control">
                                            @error('brand_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="brand_image" value="{{ old('brand_image') }}" class="form-control">
                                        </div>
                                            @error('brand_image')
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