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
            <li class="breadcrumb-item active">Orders</li>
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
              <h3 class="card-title">Orders</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Ordered Products</th>
                  <th>Order Amount</th> 
                  <th>Order Status</th> 
                  <th>Payment Method</th>
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)  
                <tr>
                  <td>{{ $order['id'] }}</td>
                  <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                  <td>{{ $order['name'] }}</td>
                  <td>
                    @foreach($order['orders_products'] as $pro)
                     {{ $pro['product_code'] }}
                    @endforeach
                  </td>
                  <td>{{ $order['grand_total'] }}</td>    
                  <td>{{ $order['order_status'] }}</td>
                  <td>{{ $order['payment_method'] }}</td>
                  
                  <td class="center"><!-- Action Icons -->
                    <a title="Order Detail" href="{{ url('admin/orders/'.$order['id']) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                    
                    @if($order['order_status']=="Shipped" || $order['order_status']=="Delivered")
                     <a title="Order Invoice" target="_blank" href="{{ url('admin/view-order-invoice/'.$order['id']) }}"><i class="fas fa-print"></i></a>
                    @endif
                  </td><!-- Action Icons -->

                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Ordered Products</th>
                    <th>Order Amount</th> 
                    <th>Order Status</th> 
                    <th>Payment Method</th>
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