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
              <li class="breadcrumb-item active">Coupons</li>
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
                <h3 class="card-title">Coupons</h3>
                <a href="{{  url('admin/add-edit-coupon') }}" 
                style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Coupon</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Coupon Type</th>
                    <th>Amount</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($coupons  as $coupon)    
                    <tr>
                        <td>{{ $coupon['id'] }}</td>
                        <td>{{ $coupon['coupon_code'] }}</td>
                        <td>{{ $coupon['coupon_type'] }}</td>
                        <td>
                            {{ $coupon['amount'] }}
                            @if($coupon['amount_type']=="Percentage")
                             %
                            @else 
                             INR
                            @endif 
                        </td>
                        <td>{{ $coupon['expiry_date'] }}</td>
                        <td>
                          @if($coupon['status']==1)
                            <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)">
                              <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                          @else
                            <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)">
                            <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>
                          @endif    
                        </td>
                        <td class="center">
                          <a title="Edit Coupon" href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;&nbsp; &nbsp;
                          <a href="javascript:void(0)" class="confirmDelete" record="coupon" recordid="{{ $coupon['id'] }}"
                          <?php /*href="{{ url('admin/delete-coupon/'.$coupon->id) }}" */ ?>>&nbsp;<i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                  @endforeach  
                  </tbody> 
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Coupon Type</th>
                        <th>Amount</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
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
  <!-- /.content-wrapper -->

@endsection