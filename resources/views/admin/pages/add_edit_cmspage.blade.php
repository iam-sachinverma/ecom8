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
            <li class="breadcrumb-item active">Cms Page</li>
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
            <form name="cmsForm" id="cmsForm" @if(empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-page') }}" @else action="{{ url('admin/add-edit-cms-page/'.$cmspage['id']) }}" @endif method="post">@csrf
              <div class="card-body">
                  <div class="row">

                    <div class="col-md-6">
                      <!-- Page Title -->
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Page Title"
                        @if(!empty($cmspage['title'])) value="{{ $cmspage['title'] }}"
                        @else value="{{ old('title') }}" @endif>
                      </div>
                      <!-- Page Desc -->
                      <div class="form-group">
                       <label for="description">Page Description</label>
                       <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($cmspage['description'])) {{ $cmspage['description'] }} 
                       @else {{ old('description') }} @endif</textarea>
                      </div>
                      <!-- Page Meta title -->
                      <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea id="meta_title" name="meta_title" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($cmspage['meta_title'])) {{ $cmspage['meta_title'] }} 
                        @else {{ old('meta_title') }} @endif</textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <!-- Page url -->
                      <div class="form-group">
                        <label for="url">Page Url</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Enter Page Title"
                        @if(!empty($cmspage['url'])) value="{{ $cmspage['url'] }}"
                        @else value="{{ old('url') }}" @endif>
                      </div>
                      <!-- Page Meta Desc -->
                      <div class="form-group">
                       <label for="meta_description">Meta Description</label>
                       <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($cmspage['meta_description'])) {{ $cmspage['meta_description'] }} 
                        @else {{ old('meta_description') }} @endif</textarea>
                      </div>
                      <!-- Page Meta Keywords -->
                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea id="meta_keywords" name="meta_keywords" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($cmspage['meta_keywords'])) {{ $cmspage['meta_keywords'] }} 
                        @else {{ old('meta_keyword') }} @endif</textarea>
                      </div>                   
                    </div>

                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>  
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection