@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            


                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                    <h3 class="widget-user-username">{{ $admin->name }}</h3>
                    <h6 class="widget-user-desc">{{ $admin->email }}</h6>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-success me-md-2 mb-5" type="button">Edit Profile</a>
                        
                      </div>
                    </div>
                    <div class="widget-user-image">
                    <img class="rounded-circle" src="{{ (!empty($admin->profile_photo_path)) ? url('upload/profile_image/'.$admin->profile_photo_path) : url('upload/no_image.jpg') }}" style="height: 110px" alt="User Avatar">
                    </div><br>
                    <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">12K</h5>
                            <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 br-1 bl-1">
                        <div class="description-block">
                            <h5 class="description-header">550</h5>
                            <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">158</h5>
                            <span class="description-text">TWEETS</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                </div>


            
        </section>
    </div>
</div>
@endsection