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
                         <h3 class="box-title">Brands Liste</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                           <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                   <tr>
                                       <th>Image Thambnail</th>
                                       <th>Product name En</th>
                                       <th>Product name Fr</th>
                                       <th>Quatity</th>
                                       <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produit as $item)
                                    <tr>
                                        
                                        <td><img src="{{ asset($item->product_thambnail) }}" alt="" height="100px" width="auto"></td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->product_name_fr }}</td>
                                        <td>{{ $item->product_qty }}</td>
                                        <td>
                                            <a href="{{ route('edit.product',$item->id) }}" class="btn btn-info sm" title="edit"><i class="fa fa-edit"></i></a>
    
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