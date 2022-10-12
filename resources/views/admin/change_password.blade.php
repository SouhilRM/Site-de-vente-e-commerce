@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            
            

            <section class="content">

                <!-- Basic Forms -->
                 <div class="box">
                   <div class="box-header with-border">
                     <h4 class="box-title">Update Password</h4>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="row">
                       <div class="col">

      
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger" role="alert">
                                {{ $error }}
                            </p>
                            @endforeach
                        @endif                    
    
    <form method="POST" action="{{ route('admin.update.password') }}">
        @csrf
        <div class="row">
        <div class="col-12">

            <div class="row mb-3">
                <div class="col-8">
                    <div class="form-group">
                        <h5>Current Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input id="current_password" type="password" name="old_password" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div class="form-group">
                        <h5>New Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input id="password" type="password" name="new_password" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div class="form-group">
                        <h5>Confirm Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input id="password_confirmation" type="password" name="confirmation_password" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
            </div>

            
           
            
        </div>
        
        </div>
        
        <div class="text-xs-right">
            <button type="submit" class="btn btn-rounded btn-success">SAVE</button>
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

@endsection