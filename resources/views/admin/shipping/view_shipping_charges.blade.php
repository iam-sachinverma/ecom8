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
            <li class="breadcrumb-item active">Shipping Charges</li>
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
              <h3 class="card-title">Shipping Charges</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>State</th>
                  <th>District</th>
                  <th>0 to 500gm</th>
                  <th>501 to 1000gm</th>
                  <th>1001 to 2000gm</th>
                  <th>2001 to 5000gm</th>
                  <th>above to 5000gm</th>
                  <th>Updated At</th>
                  <th>Status</th>
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
                @foreach($shipping_charges as $shipping)  
                <tr>
                  <td>{{ $shipping['id'] }}</td>
                  <td>{{ $shipping['state'] }}</td>
                  <td>{{ $shipping['district'] }}</td>
                  <td>&#8377; {{ $shipping['0_500gm'] }}</td>
                  <td>&#8377; {{ $shipping['501_1000gm'] }}</td>
                  <td>&#8377; {{ $shipping['1001_2000gm'] }}</td>
                  <td>&#8377; {{ $shipping['2001_5000gm'] }}</td>
                  <td>&#8377; {{ $shipping['above_5000gm'] }}</td>
                  <td>{{ date('d-m-Y', strtotime($shipping['updated_at']) ) }}</td>
                  <td>
                    @if($shipping['status']==1)
                     <a class="updateShippingStatus" id="shipping-{{ $shipping['id'] }}" shipping_id="{{ $shipping['id'] }}" href="javascript:void(0)">
                     <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                    @else
                     <a class="updateShippingStatus" id="shipping-{{ $shipping['id'] }}" shipping_id="{{ $shipping['id'] }}" href="javascript:void(0)">
                     <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                    @endif
                  </td>
                  <td class="center"><!-- Action Icons -->
                    <a title="Update Shipping Charges" href="{{ url('admin/edit-shipping-charges/'.$shipping['id']) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                  </td><!-- Action Icons -->

                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>State</th>
                  <th>District</th>
                  <th>0 to 500gm</th>
                  <th>501 to 1000gm</th>
                  <th>1001 to 2000gm</th>
                  <th>2001 to 5000gm</th>
                  <th>above to 5000gm</th>
                  <th>Updated At</th>
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