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
            <li class="breadcrumb-item active">Ratings & Reviews</li>
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
              <h3 class="card-title">Ratings & Reviews</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>User Email</th>
                  <th>Rating</th>
                  <th>Review</th> 
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)  
                <tr>
                  <td>{{ $rating['id'] }}</td>
                  <td>{{ $rating['product']['product_name'] }}</td>
                  <td>{{ $rating['user']['email'] }}</td>
                  <td>{{ $rating['review'] }}</td>
                  <td>{{ $rating['rating'] }}</td>
                  <td>
                    @if($rating['status']==1)
                      <a class="updateRatingStatus" id="rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateRatingStatus" id="rating-{{ $rating['id'] }}" rating_id="{{ $rating['id'] }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                    @endif 
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>User Email</th>
                  <th>Rating</th>
                  <th>Review</th>
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