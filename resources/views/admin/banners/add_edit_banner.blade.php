@extends('layouts.admin_layout.admin_layout')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>

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

            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible rounded-0" style="margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ Session::get('success_message')}}</strong>
              </div>
            @endif

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
              </div>
              <!-- /.card-header -->
              <form name="bannerForm" id="bannerForm" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                  <div class="card-body">
                    <div class="row"><!-- /.Row 1 -->

                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="image">Banner Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>   
                            </div>
                            <small id="main_image" class="form-text text-muted">
                              Recommended Image Size: Width:640px, Height:280px
                            </small>
                            @if(!empty($banner['image']))
                            <div><img style="width:300px; margin-top:15px;" src="{{ asset('images/banner_images/'.$banner['image']) }}">          
                            &nbsp;<a class="confirmDelete" href="javascript:void(0)" record="banner-image" recordid="{{ $banner['id'] }}">&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></a></div>
                            @endif
                        </div>
                      </div> 

                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="link">Banner link</label>
                          <input type="text" class="form-control" name="link" id="link" placeholder="Enter Banner Link"
                          @if(!empty($banner['link'])) value="{{ $banner['link'] }}"
                          @else value="{{ old('link') }}" @endif>
                        </div>
                      </div>  

                    
                    </div><!-- /.Row 1 -->

                    <div class="row"><!-- /.Row 2 -->
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="title">Banner Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter Banner Title"
                          @if(!empty($banner['title'])) value="{{ $banner['title'] }}"
                          @else value="{{ old('title') }}" @endif>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="alt">Banner Alternate Text</label>
                          <input type="text" class="form-control" name="alt" id="alt" placeholder="Enter Banner Alt"
                          @if(!empty($banner['alt'])) value="{{ $banner['alt'] }}"
                          @else value="{{ old('alt') }}" @endif>
                        </div>
                      </div>      
                    </div><!-- /.Row 2 -->

                  </div><!-- Card-Body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
            </div>
            <!-- card -->
          </div>
          <!-- col -->
        </div>
        <!-- row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection