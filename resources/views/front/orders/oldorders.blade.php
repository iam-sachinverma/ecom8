<?php use App\Models\Product;  ?>
@extends('layouts.front_layout.front_layout')
@section('content')

{{-- <div class="row">
    <table>
        <tr>
            <th>Order Id</th>
            <th>Order Product</th>
            <th>Order Payment Method</th>
            <th>Amount</th>
            <th>Created On</th>
        </tr>
        @foreach($orders as $order)
         <tr>
            <td>{{ $order['id'] }}</td>
            <td>
                @foreach($order['orders_products'] as $pro)
                 {{ $pro['product_code'] }}
                @endforeach
            </td>
            <td>{{ $order['payment_method'] }}</td>
            <td>{{ $order['grand_total'] }}</td>
            <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
         </tr>
        @endforeach
    </table>
</div> --}}

<header class="app-header fixed-top onlight shadow-sm">
		
    <a href="{{ url()->previous() }}" class="btn-header">
		<i class="material-icons md-arrow_back text-dark"></i>
	</a>
    
    <a href="{{ url('/') }}"><h5 class="title-header text-dark">  PantryShop  </h5></a>
    
    @if(Auth::check())
        <a href="{{ url('/account') }}" class="btn-header"> 
            <i class="material-icons md-account_circle"></i> 
        </a> 
	@else
        <a href="{{ url('/login-register') }}" class="btn-header"> 
            Login &nbsp; 
        </a>
	@endif 

</header> <!-- app-header.// --> 

<main class="app-content bg-light">

    {{-- <header class="app-header onlight shadow-sm mb-2">
		    <div class="d-flex" style="position: absolute">
            
           <input type="text" placeholder="Search your order here" class="form-control bg-light mx-2">

           <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Filter</button>

        </div>
    </header> <!-- app-header.// -->  --}}


    @foreach($orders as $order)
     @foreach($order['orders_products'] as $pro)
  
      <article class="product-list d-flex mb-2 bg-white">
        <div>
          <?php $getProductImage = Product::getProductImage($pro['product_id']) ?>
          <a target="_blank" href="{{ url('product/'.$pro['product_id']) }}">
           <img class="img-fluid" src="{{ asset('images/product_images/small/'.$getProductImage) }}" alt="">
          </a>
        </div>
        <div class="d-flex align-content-center flex-wrap mx-2 ">
        
          <p class="title"> Order Placed at <strong style="color: green">{{ date('j/m/Y, g:i a', strtotime($order['created_at'])) }}</strong> 
          {{-- @foreach ($orderLog as $log)
            <strong>{{ $log['order_status'] }}</strong><br>
            {{ date('j F, Y, g:i a', strtotime($log['created_at'])) }}
            <hr> 
          @endforeach --}}
          <br>
           {{ $pro['product_name'] }}  
          </p>        
        </div>
      </article> <!-- product-list end// -->
		
     @endforeach
    @endforeach
     
</main>

{{-- Filter Offcanvas --}}
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    
  </div>
</div>

@endsection