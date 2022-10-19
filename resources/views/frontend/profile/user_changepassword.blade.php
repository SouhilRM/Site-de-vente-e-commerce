@extends('frontend.main_master')
@section('content')

<div class="body-content">
	<div class="container">
		<div class="row">
      
			 @include('frontend.common.user_sidebar')

			<div class="col-md-2">
				
			</div> <!-- // end col md 2 -->


			<div class="col-md-6">
  <div class="card">
  	<h3 class="text-center">Change Password</h3>

  	<div class="card-body">
  		
  		<form method="post" action="{{ route('user.update.password') }}" enctype="multipart/form-data">
  			@csrf


            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Password <span> </span></label>
                <input type="password" name="oldPassword" class="form-control">
                @error('oldPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">New Password <span> </span></label>
                <input type="password" name="newPassword" class="form-control">
                @error('newPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Confirm Password <span> </span></label>
                <input type="password" name="confirmPassword" class="form-control">
                @error('confirmPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">            
            <button type="submit" class="btn btn-danger">Update</button>
            </div>         
 
  		</form> 

  	</div>
  </div>	
			</div> <!-- // end col md 6 -->
		</div> <!-- // end row -->
	</div>
</div>

@endsection