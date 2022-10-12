@extends('admin.admin_master')
@section('admin')

<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            
            

            <section class="content">

                <!-- Basic Forms -->
                 <div class="box">
                   <div class="box-header with-border">
                     <h4 class="box-title">EditProfile Page</h4>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="row">
                       <div class="col">

                        
    <form method="POST" action="{{ route('admin.profile.store') }}" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-group">
                        <h5>Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" value={{$admin->name}} name="name" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <h5>Email <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="email" value={{$admin->email}} name="email" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-group">
                        <h5>Profile Image <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" id="image" name="profile_photo_path" class="form-control" required> </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <img id="showImage" src="{{ (!empty($admin->profile_photo_path)) ? url('upload/profile_image/'.$admin->profile_photo_path) : url('upload/no_image.jpg') }}" height="100px" width="auto" alt="">
                    </div>
                </div>
            </div>
            
           
            
        </div>
        
        </div>
        
        <div class="text-xs-right">
            <button type="submit" class="btn btn-rounded btn-success">Update</button>
        </div>
    </form>
       


                       </div>
                       <!-- /.col -->
                     </div>
                     <!-- /.row -->
                   </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->
       
               </section> 

            
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