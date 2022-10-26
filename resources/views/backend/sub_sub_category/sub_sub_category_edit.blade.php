@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                
                <div class="col-12">
    
                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">Edit Sub-Sub-Category</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('update.sub.sub.categorie') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $subsubcategory->id }}">
                                    
                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="categorie_id" id="select" class="form-control" aria-invalid="false">
                                                <option value="">Select One Category</option>
                                                @foreach ($categorie as $item)
                                                    <option value="{{ $item->id }}" {{ ($item->id == $subsubcategory->categorie_id)? 'selected' : '' }}>{{ $item->categorie_name_en }}</option>
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
                                                <option value="" disabled="">Select SubCategory</option>
                                                @foreach($subcatrgiries as $subsub)
                                                    <option value="{{ $subsub->id }}" {{ $subsub->id == $subsubcategory->categorie_id ? 'selected':'' }} >{{ $subsub->categorie_name_en }}</option>	
                                                @endforeach
                                    
                                            </select>
                                            @error('sub_categorie_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <h5>Sub-Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="categorie_name_en" value="{{ $subsubcategory->categorie_name_en }}" class="form-control">
                                            @error('categorie_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="categorie_name_fr" value="{{ $subsubcategory->categorie_name_fr }}" class="form-control">
                                            @error('categorie_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-rounded btn-success">UPDATE</button>
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
      $('select[name="categorie_id"]').on('change', function(){
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