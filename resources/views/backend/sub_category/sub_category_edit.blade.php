@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                
                <div class="col-12">
    
                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">Edit SubCategory</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('update.sub.categorie') }}" enctype="multipart/form-data">
                                    @csrf
                                          
                                    <input type="hidden" name="id" value="{{ $subcategory->id }}">

                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category" id="select" class="form-control" aria-invalid="false">
                                                <option value="">Select One Category</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}" {{ ($item->id == $subcategory->categorie_id)? 'selected' : '' }}>{{ $item->categorie_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $subcategory->categorie_name_en }}" type="text" name="categorie_name_en" class="form-control">
                                            @error('categorie_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $subcategory->categorie_name_fr }}" type="text" name="categorie_name_fr" class="form-control">
                                            @error('categorie_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
@endsection