@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                       <div class="box-header with-border">
                         <h3 class="box-title">SubCategory Liste</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                   <tr>
                                        <th>Category</th>
                                        <th>Sub-Category En</th>
                                        <th>Sub-Category En</th>
                                        <th>Actions</th>
                                       
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategory as $item)
                                    <tr>
                                        <td>{{ $item['categorie']['categorie_name_en'] }}</td>
                                        <td>{{ $item->categorie_name_en }}</td>
                                        <td>{{ $item->categorie_name_fr }}</td>
                                        <td>
                                            <a href="{{ route('edit.sub.categorie',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>
    
                                            <a href="{{ route('delete.sub.categorie',$item->id) }}" class="btn btn-danger sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
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
                         <h3 class="box-title">Add New SubCategory</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">


                                <form method="POST" action="{{ route('store.sub.categorie') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category" id="select" class="form-control" aria-invalid="false">
                                                <option value="">Select One Category</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->categorie_name_en }}</option>
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
                                            <input id="current_password" type="text" name="categorie_name_en" class="form-control">
                                            @error('categorie_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Name French <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="current_password" type="text" name="categorie_name_fr" class="form-control">
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
@endsection