@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">Sub-SubCategory Liste</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                   <tr>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Sub-Sub-Category En</th>
                                        <th>Sub-Sub-Category Fr</th>
                                        <th>Actions</th>
                                       
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subsubcategory as $item)
                                    <tr>
                                        <td>{{ $item['categorie']['categorie_name_en'] }}</td>
                                        <td>{{ $item['sub_categorie']['categorie_name_en'] }}</td>
                                        <td>{{ $item->categorie_name_en }}</td>
                                        <td>{{ $item->categorie_name_fr }}</td>
                                        <td>
                                            <a href="{{ route('edit.sub.sub.categorie',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>
    
                                            <a href="{{ route('delete.sub.sub.categorie',$item->id) }}" class="btn btn-danger sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
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
                         <h3 class="box-title">Add New Sub-Sub-Category</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('store.sub.sub.categorie') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="categorie_id" id="select" class="form-control" aria-invalid="false">
                                                <option value="">Select One Category</option>
                                                @foreach ($categorie as $item)
                                                    <option value="{{ $item->id }}" {{ old('categorie_id')==$item->id ? 'selected':'' }}>{{ $item->categorie_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('categorie_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="sub_categorie_id" class="form-control"  >
                                                <option value="" selected="" disabled="">Select SubCategory</option>
                                    
                                            </select>
                                            @error('sub_categorie_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <h5>Sub-Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="categorie_name_en" value="{{ old('categorie_name_en') }}" class="form-control">
                                            @error('categorie_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="categorie_name_fr" value="{{ old('categorie_name_fr') }}" class="form-control">
                                            @error('categorie_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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

<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="categorie_id"]').on('click', function(){
            var categorie_id = $(this).val();
            if(categorie_id) {
                $.ajax({
                    url: "{{  url('/categorie/subcategorie/ajax') }}/"+categorie_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="sub_categorie_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="sub_categorie_id"]').append('<option value="'+ value.id +'">' + value.categorie_name_en + '</option>');
                            });
                        },
                    });
                }
                
        });
    });
</script>
@endsection