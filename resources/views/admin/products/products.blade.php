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
            <li class="breadcrumb-item active">Products</li>
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
              <h3 class="card-title">Products</h3>
              <a href="{{  url('admin/add-edit-product') }}" 
                style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Product</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Section</th>
                  <th>Category</th> 
                  <th>Status</th> 
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)  
                <tr>
                  <td>{{ $product->id }}</td>

                  <td>{{ $product->product_name }}</td>
                 
                  <td>
                    <?php $product_image_path = "images/product_images/small/".$product->main_image; ?>
                    @if(!empty($product->main_image) && file_exists($product_image_path))
                      <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}">
                    @else 
                      <img style="width: 100px;" src="{{ asset('images/product_images/small/no-image.png') }}">
                    @endif 
                  </td>
                    
                  <td>{{ $product->section->name }}</td>

                  <td>{{ $product->category->category_name }}</td>
                  
                  <td>
                    @if($product->status==1)
                      <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                    @endif 
                  </td>

                  <td class="center"><!-- Action Icons -->
                    <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>&nbsp;
                    <a title="Add/Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fab fa-adn"></i></a> &nbsp;
                    <a title="Add Product Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-file-image"></i></a> &nbsp;
                    <a title="Delete Product" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}"
                    <?php /*href="{{ url('admin/delete-product/'.$product->id) }}"*/ ?>>&nbsp;<i class="fas fa-trash-alt"></i></a> 
                  </td><!-- Action Icons -->

                </tr>
                @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Section</th>
                    <th>Category</th> 
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
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection