@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
  <!-- Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Catalogues</h1>

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

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product Images</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid"> <!-- Add Image -->
      <form name="addImageForm" id="addImageForm" action="{{ url('admin/add-images/'.$productdata['id']) }}" method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default"> <!-- Card -->
         
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            
            <div class="row">
              <div class="col-sm-6">

                <div class="form-group">
                  <label for="product_code">Product Code:</label>&nbsp;&nbsp; {{ $productdata['product_code'] }}
                </div>

                <div class="form-group">
                  <label for="product_name">Product Name:</label>&nbsp;&nbsp; {{ $productdata['product_name'] }}
                </div>
                
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <img class="img-fluid img-thumbnail" style="width:140px; max-height:120px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}">
                </div>
              </div>
            </div>  
            
            <div class="row mt-4">
              <div class="col-12">
                <div class="form-group">
                  <div class="field_wrapper">
                    <div>
                      <input multiple="" id="images" type="file" name="images[]" value="" style="width: 120px;" required=""/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Images</button>
          </div>
  
        </div><!-- Card -->
      </form>
    </div><!-- Add Image -->


    <div class="container-fluid"><!-- Display Images -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Images</h3>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($productdata['images'] as $image)
                  <tr>
                    <td>{{ $image['id'] }}</td>
                    <td>
                      <img class="img-fluid img-thumbnail" style="width:140px; max-height:120px;" src="{{ asset('images/product_images/large/'.$image['image']) }}">
                    </td>
                    <td>
                      @if( $image['status'] == 1 )
                      <a class="updateImageStatus" id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}" href="javascript:void(0)">
                        <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                      @else
                      <a class="updateImageStatus" id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}" href="javascript:void(0)">
                        <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                      @endif 
                    </td>
                    <td>
                      <a title="Delete Product Image" href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $image['id'] }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Status</th>
                    <th>Action</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- Display Images -->

  </section>

</div>

@endsection