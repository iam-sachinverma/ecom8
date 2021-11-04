@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Admin Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Admin Details</h3>
                    </div>

                    @if(Session::has('error_message'))
                      <div class="alert alert-warning alert-dismissible rounded-0" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('error_message')}}</strong>
                      </div>
                    @endif

                    @if(Session::has('success_message'))
                      <div class="alert alert-success alert-dismissible rounded-0" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success_message')}}</strong>
                      </div>
                    @endif

                    @if ($errors->any())
                      <div class="alert alert-danger alert-dismissible rounded-0" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>
                              @foreach ($errors->all() as $error)
                                  <li style="list-style-type:none;">{{ $error }}</li>
                              @endforeach
                          </strong>
                      </div>
                    @endif
                    
                    <form action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetails" id="updateAdminDetails" method="post" role="form" enctype="multipart/form-data">@csrf 
                        <div class="card-body">

                            <div class="form-group">
                                <label for="admin_email">Admin Email</label>
                                <input class="form-control" id="admin_email" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="admin_type">Admin Type</label>
                                <input class="form-control" id="admin_type" value="{{ Auth::guard('admin')->user()->type }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="admin_name">Admin Name</label>
                                <input type="text" class="form-control" id="admin_name" name="admin_name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter Admin Name" required="">                         
                            </div>
                            <div class="form-group">
                                <label for="admin_mobile">Phone Number</label>
                                <input type="number" class="form-control" id="admin_mobile" name="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}"  placeholder="Enter Admin Phone Number" required=""> 
                            </div>

                            <!--<div class="form-group">
                                <label for="admin_image">Admin Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="admin_image" name="admin_image" accept="image/*">
                                      <label class="custom-file-label" for="admin_image">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                      <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                                
                            </div>-->

                            <div class="form-group">
                              <label for="">Image</label>
                              <input type="file" class="form-control" name="admin_image" id="admin_image" accept="image/*">
                              @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                                <input type="hidden" id="current_admin_image" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                              @endif
                            </div>
                        
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
       </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
@endsection