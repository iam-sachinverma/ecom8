<?php use App\Models\Product;  ?>
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
            <li class="breadcrumb-item active">Orders No. #{{ $orderDetails['id'] }} Details</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Orders Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Order Date</td>
                    <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                  </tr>
                  <tr>
                    <td>Order Status</td>
                    <td>{{ $orderDetails['order_status'] }}</td>
                  </tr>

                  @if(!empty($orderDetails['courier_name']))
                  <tr>
                    <td>Courier Name</td>
                    <td>{{ $orderDetails['courier_name'] }}</td>
                  </tr>
                  @endif

                  @if(!empty($orderDetails['tracking_number']))
                  <tr>
                    <td>Tracking Number</td>
                    <td>{{ $orderDetails['tracking_number'] }}</td>
                  </tr>
                  @endif

                  <tr>
                    <td>Grand Total</td>
                    <td>{{ $orderDetails['grand_total'] }}</td>
                  </tr>
                  <tr>
                    <td>Shipping Charges</td>
                    <td>{{ $orderDetails['shipping_charges'] }}</td>
                  </tr>
                  <tr>
                    <td>Coupon Code</td>
                    <td>{{ $orderDetails['coupon_code'] }}</td>
                  </tr>
                  <tr>
                    <td>Coupon Amount</td>
                    <td>{{ $orderDetails['coupon_amount'] }}</td>
                  </tr>
                  <tr>
                    <td>Payment Method</td>
                    <td>{{ $orderDetails['payment_method'] }}</td>
                  </tr>
                  <tr>
                    <td>Payment Gateway</td>
                    <td>{{ $orderDetails['payment_gateway'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Delivery Address</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                      <td>Mobile</td>
                      <td>{{ $orderDetails['mobile'] }}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                      <td>Landmark</td>
                      <td>{{ $orderDetails['landmark'] }}</td>
                    </tr>
                    <tr>
                      <td>Area</td>
                      <td>{{ $orderDetails['area'] }}</td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td>{{ $orderDetails['state'] }} - {{ $orderDetails['pincode'] }} </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customer Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $userDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td>{{ $userDetails['mobile'] }}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>{{ $userDetails['email'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Update Order Status</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>
                      <form action="{{ url('admin/update-order-status') }}" method="post">@csrf
                        <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                        <div class="d-flex">
                          
                          <select class="form-select" id="order_status" name="order_status" aria-label="Default select example" required>
                            <option selected>Update Status</option>
                            @foreach($orderStatuses as $status)
                              <option value="{{ $status['name'] }}" 
                                @if(isset($orderDetails['order_status']) 
                                && $orderDetails['order_status'] == $status['name'] ) selected="" 
                                @endif>
                                {{ $status['name'] }}
                              </option>
                            @endforeach
                          </select>
                          
                          &nbsp;&nbsp;
                          <input style="width:120px" type="text" name="courier_name"  
                           @if(empty($orderDetails['courier_name'])) id="courier_name" @endif
                           value="{{ $orderDetails['courier_name'] }}" placeholder="Courier Name">
                          &nbsp;&nbsp;
                         
                          <input style="width:130px" type="text" name="tracking_number"
                           @if(empty($orderDetails['tracking_number'])) id="tracking_number" @endif
                           value="{{ $orderDetails['tracking_number'] }}" placeholder="Tracking Number">
                          &nbsp;&nbsp;
                          
                          <button type="submit" class="btn btn-primary btn-sm">Update</button>

                        </div>
                      </form> 
                    </td>
                  </tr>

                  <td colspan="2">
                    
                    @foreach($orderLog as $log)
                     <strong>{{ $log['order_status'] }}</strong><br>
                     <small>{{ date('j F, Y, g:i a', strtotime($log['created_at'])) }}</small>
                     
                      @if($log['reason']!="") 
                      &nbsp;&nbsp;&nbsp;  <small> {{ $log['reason'] }} </small> 
                      @endif
                      <hr>

                    @endforeach

                    <div style=" background-color: 	#00FA9A;">
                      <strong>Order Placed At: </strong><br>
                      {{ date('j F, Y, g:i a', strtotime($orderDetails['created_at'])) }}
                      <hr>
                    </div>
                    
                  </td>


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order Product</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Qty</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($orderDetails['orders_products'] as $product)  
                  <tr>
                    <td>
                    <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                    <a target="_blank" href="{{ url('product/'.$product['product_id']) }}">
                     <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$getProductImage) }}" alt="">
                    </a>
                    </td>
                    <td>{{ $product['product_code'] }}</td>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['product_size'] }}</td>
                    <td>{{ $product['product_qty'] }}</td>
                  </tr>
                @endforeach  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  
</div>

@endsection