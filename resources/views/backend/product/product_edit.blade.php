@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
<div class="container-full">
<section class="content">

                
    <div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Update Product </h4>
    </div>     
    <div class="box-body">


        <!-- required ne marche pas sur les tags et les long description !! -->

        <form method="post" action="{{ route('update.product') }}" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="id" value="{{ $products->id }}">
            <div class="row">
                <!-- categorie -->
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Category Select <span class="text-danger">*</span></h5>
                        
                        <select name="categorie_id" class="form-control" required>
                            <option value="">Select One Category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $products->categorie_id ? 'selected' : '' }}>{{ $item->categorie_name_en }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror 
                        
                    </div>
                </div>

                <!-- subcategorie -->
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                        
                        <select name="sub_categorie_id" class="form-control" required>
                            <option value="">Select SubCategory</option>
                            @foreach ($subcategory as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $products->sub_categorie_id ? 'selected' : '' }}>{{ $item->categorie_name_en }}</option>
                            @endforeach
                        </select>
                        @error('sub_categorie_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror 
                        
                    </div>
                </div>

                <!-- subsubcategorie -->
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                        
                        <select name="sub_sub_categorie_id" class="form-control" required>
                            <option>Select SubSubCategory</option>
                            @foreach ($subsubcategory as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $products->sub_sub_categorie_id ? 'selected' : '' }}>{{ $item->categorie_name_en }}</option>
                            @endforeach
                        </select>
                        @error('sub_sub_categorie_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror 
                        
                    </div>
                </div>
            </div><!-- end row 1 --><br>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Brand Select <span class="text-danger">*</span></h5>
                        
                        <select name="brand_id" class="form-control" required>
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>	
                            @endforeach
                        </select>
                        @error('brand_id') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror 
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Name En <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_name_en" value="{{ $products->product_name_en }}" class="form-control" required>
                        @error('product_name_en') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Name Fr <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_name_fr" value="{{ $products->product_name_fr }}" class="form-control" required>
                        @error('product_name_fr') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>
            </div><!-- end row 2 --><br>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Tags En <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_tags_en" class="form-control" value="{{ $products->product_tags_en }}" data-role="tagsinput">
                        @error('product_tags_en') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Tags Fr <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_tags_fr" class="form-control" value="{{ $products->product_tags_fr }}" data-role="tagsinput">
                        @error('product_tags_fr') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Size En <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_size_en" class="form-control" value="{{ $products->product_size_en }}" data-role="tagsinput">
                        @error('product_size_en') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

            </div><!-- end row 3 --><br>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Size Fr <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_size_fr" class="form-control" value="{{ $products->product_size_fr }}" data-role="tagsinput">
                        @error('product_size_fr') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Color En <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_color_en" class="form-control" value="{{ $products->product_color_en }}" data-role="tagsinput">
                        @error('product_color_en') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Product Color Fr <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_color_fr" class="form-control" value="{{ $products->product_color_fr }}" data-role="tagsinput">
                        @error('product_color_fr') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>
            </div><!-- end row 4 --><br>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Product Code <span class="text-danger">*</span></h5>
                        
                        <input type="text" name="product_code" value="{{ $products->product_code }}" class="form-control" required>
                        @error('product_code') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                        
                        <input type="number" name="product_qty" value="{{ $products->product_qty }}" class="form-control" required>
                        @error('product_qty') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                        
                        <input type="number" step="any" min="0" name="selling_price" value="{{ $products->selling_price }}" class="form-control" required>
                        @error('selling_price') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Product Discount Price <span class="text-danger">*</span></h5>
                        
                        <input type="number" step="any" min="0" name="discount_price" value="{{ $products->discount_price }}" class="form-control" required>
                        @error('discount_price') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>     
                </div>
            </div><!-- end row 5 --><br>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Change Main Thambnail <span class="text-danger">*</span></h5>
                        
                        <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)">
                        @error('product_thambnail') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <img src="{{ asset($products->product_thambnail) }}" id="mainThmb" height="200px" width="auto">
                        
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <h5>Add More Images <span class="text-danger">*</span></h5>
                        
                        <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg">
                        @error('multi_img') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group" id="preview_img"></div>
                        
                    </div>
                </div>

            </div><!-- end row 6 --><br>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Short Description English <span class="text-danger">*</span></h5>
                        
                        <textarea name="short_descp_en" id="textarea" class="form-control" required>{{ $products->short_descp_en }}</textarea>
                        @error('short_descp_en') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Short Description French <span class="text-danger">*</span></h5>
                        
                        <textarea name="short_descp_fr" id="textarea" class="form-control" required>{{ $products->short_descp_fr }}</textarea>
                        @error('short_descp_fr') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                </div>
            </div><!-- end row 7 --><br>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <h5>Long Description English <span class="text-danger">*</span></h5>
                
                    <textarea id="editor1" name="long_descp_en" rows="10" cols="80">{{ $products->long_descp_en }}</textarea>
                    @error('long_descp_en') 
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <h5>Long Description French <span class="text-danger">*</span></h5>
                
                    <textarea id="editor2" name="long_descp_fr" rows="10" cols="80">{{ $products->long_descp_fr }}</textarea>
                    @error('long_descp_fr') 
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                    </div>
                </div>
            </div><!-- end row 8 --><hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals ? 'checked' : '' }}>
                            <label for="checkbox_2">Hot Deals</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured ? 'checked' : '' }}>
                            <label for="checkbox_3">Featured</label>
                        </fieldset>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer ? 'checked' : '' }}>
                            <label for="checkbox_4">Special Offer</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals ? 'checked' : '' }}>
                            <label for="checkbox_5">Special Deals</label>
                        </fieldset>
                    </div>
                </div>
            </div><!-- end row 9 --><br>

            <div class="box-footer text-xs-right">
                <button type="submit" class="btn btn-info" value="Add-Product">Update Product</button>
            </div>
        </form>

    </div>
    </div>


    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Update Product Multi-Images </h4>
        </div>     
        <div class="box-body">
    
    
            <form method="post" action="{{ route('update.product.images') }}" enctype="multipart/form-data" >
                @csrf
    
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                               <th>Images</th>
                               <th>Date Added</th>
                               <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->products as $item)
                            <tr>
                                
                                <td><img src="{{ asset($item->photo) }}" alt="" height="180px" width="auto"></td>
                                <td>{{ $item->created_at }}</td>
                                
                                <td>
                                    <div class="row">
                                        <div class="col-md-9">
                                        <input type="file" name="multi_img[{{  $item->id }}]" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <a href="{{ route('delete.product.images',$item->id) }}" class="btn btn-danger sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                        
                                    </div>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
    
                <div class="box-footer text-xs-right">
                    <button type="submit" class="btn btn-info" value="Add-Product">Update Multi Images</button>
                </div>
            </form>
    
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
                    url: "{{  url('/product/subcategorie/ajax') }}/"+categorie_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="sub_sub_categorie_id"]').empty();
                        var d =$('select[name="sub_categorie_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="sub_categorie_id"]').append('<option value="'+ value.id +'">' + value.categorie_name_en + '</option>');
                            });
                        },
                    });
                }
                
        });
    });

    $(document).ready(function() {
      $('select[name="sub_categorie_id"]').on('change', function(){
            var sub_categorie_id = $(this).val();
            if(sub_categorie_id) {
                $.ajax({
                    url: "{{  url('/product/subsubcategorie/ajax') }}/"+sub_categorie_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="sub_sub_categorie_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="sub_sub_categorie_id"]').append('<option value="'+ value.id +'">' + value.categorie_name_en + '</option>');
                            });
                        },
                    });
                }
                
        });
    });
</script>

<script type="text/javascript">
	function mainThamUrl(input){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
	}	
</script>

<script>
    $(document).ready(function(){
        $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                
                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width('auto').height('120px'); //create image element 
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    }); 
</script>

@endsection