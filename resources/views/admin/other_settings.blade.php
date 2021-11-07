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
              <li class="breadcrumb-item active">Other Settings</li>
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
                        <h3 class="card-title">Cart Value</h3>
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

                    <form action="{{ url('/admin/update-other-settings') }}" name="updateOtherSettingForm" id="updateOtherSettingForm" method="post" role="form">@csrf 
                        <div class="card-body">

                          <div class="form-group">
                              <label for="min_cart_value">Min Cart Value</label>
                              <input type="number" class="form-control" id="min_cart_value"  name="min_cart_value" value="{{ $otherSettings['min_cart_value'] }}" placeholder="Enter min cart value" required="">
                          </div>
                          <div class="form-group">
                              <label for="max_cart_value">Max Cart Value</label>
                              <input type="number" class="form-control" id="max_cart_value" name="max_cart_value" value="{{ $otherSettings['max_cart_value'] }}" placeholder="Enter max cart value" required="">                         
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