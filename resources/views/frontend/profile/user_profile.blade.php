@extends('frontend.main_master')
@section('content')

<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="body-content">
	<div class="container">
		<div class="row">
      
			 @include('frontend.common.user_sidebar')

			<div class="col-md-2">
				
			</div> <!-- // end col md 2 -->


			<div class="col-md-6">
  <div class="card">
  	<h3 class="text-center">Update Profile</h3>

  	<div class="card-body">
  		


  		<form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
  			@csrf


            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Name <span> </span></label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email <span> </span></label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>


            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Phone <span> </span></label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">User Image <span> </span></label>
                <input type="file" id="image" name="profile_photo_path" class="form-control">
            </div>
            <div class="form-group">
                <img id="showImage" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_image/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" height="100px" width="auto" alt="">
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