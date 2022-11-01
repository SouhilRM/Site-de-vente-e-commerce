@extends('admin.admin_master')
@section('admin')

<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
<div class="container-full">
<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Products Liste</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image Thambnail</th>
                <th>Product name En</th>
                <th>Product Price</th>
                <th>Quatity</th>
                <th>Discount</th>
				<th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produit as $item)
            <tr>
                <td class="text-center"><img src="{{ asset($item->product_thambnail) }}" alt="" height="150px" width="180px"></td>
                <td>{{ $item->product_name_en }}</td>
                <td>{{ $item->selling_price }}</td>
                <td>{{ $item->product_qty }}</td>
                <td class="text-center">
                    @if($item->discount_price == NULL)
                        <span class="badge badge-pill badge-primary">No Discount</span>
                    @else
                        @php
                            $amount = $item->selling_price - $item->discount_price;
                            $discount = ($amount/$item->selling_price) * 100;
                        @endphp
                        <span class="badge badge-pill badge-primary">{{ round($discount)  }} %</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($item->status)
                        <span class="badge badge-pill badge-success"> Active </span>
                    @else
                        <span class="badge badge-pill badge-danger"> InActive </span>
                    @endif
                </td>
                <td> 
                    <a href="{{ route('edit.product',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>

                    <a href="{{ route('delete.product',$item->id) }}" class="btn btn-warning sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
                    
                    @if($item->status)
                    <a href="{{ route('inactive.product',$item->id) }}" class="btn btn-danger float-right" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                    @else
                    <a href="{{ route('active.product',$item->id) }}" class="btn btn-success float-right" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
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