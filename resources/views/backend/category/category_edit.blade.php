@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                
                <div class="col-12">
    
                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">Edit Category</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('update.categorie') }}" enctype="multipart/form-data">
                                    @csrf
                                          
                                    <input type="hidden" name="id" value="{{ $category->id }}">

                                    <div class="form-group">
                                        <h5>Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $category->categorie_name_en }}" type="text" name="categorie_name_en" class="form-control">
                                            @error('categorie_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Category Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" value="{{ $category->categorie_name_fr }}" type="text" name="categorie_name_fr" class="form-control">
                                            @error('categorie_name_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="categorie_icone" value="{{ $category->categorie_icone }}" class="form-control">
                                        </div>
                                            @error('categorie_icone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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