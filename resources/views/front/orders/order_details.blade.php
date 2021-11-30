<?php 
 
 use App\Models\Product;
 use App\Models\Order;
 $getOrderStatus = Order::getOrderStatus($orderDetails['id']);

?>

@extends('layouts.front_layout.front_layout')
@section('content')
    
  @if(Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
      <strong>{{ Session::get('error_message')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php Session::forget('error_message'); ?>
  @endif

  @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
      <strong>{{ Session::get('success_message')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php Session::forget('success_message'); ?>
  @endif

  <!-- Cancel Order Form Modal-->
  <div class="modal fade" id="cancelOrder-modal" tabindex="-1" role="dialog">
    <form method="post" id="cancelOrderReasonForm" action="{{ url('orders/'.$orderDetails['id'].'/cancel') }}">@csrf
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            
            <a class="nav-link fw-medium active" href="#cancelOrder-tab" data-bs-toggle="tab" role="tab" aria-selected="true">
              <i class="ci-unlocked me-2 mt-n1"></i>Select Reason For Cancel Order
            </a>
      
          </div>
          <div class="modal-body tab-content py-4">
            
            <select class="form-select" name="reason" id="cancelReason">
              <option value="">Select Reason</option>
              <option value="Order Created by Mistake">Order Created by Mistake </option>			
              <option value="Shipping Cost too High">Shipping Cost too High </option>
              <option value="Found Cheaper Somewhere Else">Found Cheaper Somewhere Else </option>
              <option value="Something Else">Something Else</option>
            </select>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button type="submit" form="cancelOrderReasonForm" class="btn btn-primary btnCancelOrder">Cancel Order</button>
          </div>
        </div>
      </div>
    </form>  
  </div>

  @if($getOrderStatus=="New")
  <h2>
    <span style="float: right;">
      <a href="#cancelOrder-modal" data-bs-toggle="modal">
      <button type="button" class="btn btn-danger my-3 me-3">Cancel Order</button>
      </a>
    </span>
  </h2>
  @endif

  <div class="container-fluid py-5 mb-2 mb-md-3">
    <!-- Progress-->
    <div class="card border-0">
      <div class="card-body pb-2">
        <ul class="nav nav-tabs media-tabs nav-justified">
          <li class="nav-item">
            <div class="nav-link completed">
              <div class="d-flex align-items-center">
                <div class="media-tab-media"><i class="ci-bag"></i></div>
                <div class="ps-4">
                  <div class="media-tab-subtitle text-muted fs-xs mb-1">First step</div>
                  <h6 class="media-tab-title text-nowrap mb-0">Order placed</h6>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <div class="nav-link active">
              <div class="d-flex align-items-center">
                <div class="media-tab-media"><i class="ci-settings"></i></div>
                <div class="ps-4">
                  <div class="media-tab-subtitle text-muted fs-xs mb-1">Second step</div>
                  <h6 class="media-tab-title text-nowrap mb-0">Processing order</h6>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <div class="nav-link">
              <div class="d-flex align-items-center">
                <div class="media-tab-media"><i class="ci-star"></i></div>
                <div class="ps-4">
                  <div class="media-tab-subtitle text-muted fs-xs mb-1">Third step</div>
                  <h6 class="media-tab-title text-nowrap mb-0">Quality check</h6>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <div class="nav-link">
              <div class="d-flex align-items-center">
                <div class="media-tab-media"><i class="ci-package"></i></div>
                <div class="ps-4">
                  <div class="media-tab-subtitle text-muted fs-xs mb-1">Fourth step</div>
                  <h6 class="media-tab-title text-nowrap mb-0">Product dispatched</h6>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container pb-5 mb-2 mb-md-4">
    <hr>
    <div class="row pt-5 mt-2">
      <!-- Entries list-->
      <section class="col-lg-8">
        
      @foreach($orderDetails['orders_products'] as $product)
          <!-- Item-->
          <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
            <div class="d-sm-flex text-center text-sm-start">

              <?php $getProductImage = Product::getProductImage($product['product_id']) ?> 
              <a class="d-inline-block flex-shrink-0 mx-auto" href="{{ url('product/'.$product['product_id']) }}" style="width: 10rem;">
                <img src="{{ asset('images/product_images/small/'.$getProductImage) }}" alt="Product">
              </a>

              <div class="ps-sm-4 pt-2">
                <h3 class="product-title fs-base mb-2"><a href="shop-single-v1.html">{{ $product['product_name'] }}</a></h3>
                <div class="fs-sm"><span class="text-muted me-2">Size:</span>{{ $product['product_size'] }}</div>
                <div class="fs-sm"><span class="text-muted me-2">Brand:</span>{{ $product['product_brand'] }}</div>
                <div class="fs-lg text-accent pt-2">&#8377 {{ $product['product_price'] }}</div>
              </div>
            </div>
            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
              <div class="text-muted mb-2">Quantity:</div>{{ $product['product_qty'] }}
            </div>
            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
              <?php $subtotal = $product['product_price']*$product['product_qty']  ?>
              <div class="text-muted mb-2">Subtotal</div>&#8377 {{ $subtotal }}
            </div>
          </div>
      @endforeach    
        
      </section>

      <aside class="col-lg-4">
        <!-- Sidebar-->
        <div class="offcanvas offcanvas-collapse offcanvas-end border-start ms-lg-auto" id="blog-sidebar" style="max-width: 22rem;">
          <div class="offcanvas-header align-items-center shadow-sm">
            <h2 class="h5 mb-0">Sidebar</h2>
            <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body py-grid-gutter py-lg-1 px-lg-4" data-simplebar data-simplebar-auto-hide="true">

            <!-- ADDRESS -->
            <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom mx-lg-2">
              <h3 class="widget-title">Address</h3>
              <ul class="widget-list">
                <p>
                  {{ $orderDetails['name'] }} <br> {{ $orderDetails['address'] }} , {{ $orderDetails['area'] }} ,
                    Near {{ $orderDetails['landmark'] }} <br> {{ $orderDetails['state'] }} - {{ $orderDetails['pincode'] }}
                    <br> <strong>Phone number: </strong>{{ $orderDetails['mobile'] }}
                </p>

              </ul>
            </div>
            <!-- PRICE DETAILS -->
            <div class="widget mb-grid-gutter pb-grid-gutter border-bottom mx-lg-2">
              <h3 class="widget-title">Price Details</h3>
              <div class="d-flex align-items-center mb-3">
              
              <ul class="list-unstyled fs-sm pt-4 pb-2 border-bottom">
                <li class="d-flex justify-content-between align-items-center">
                  <span class="me-2">Grandtotal:</span>
                  <span class="text-end fw-medium">&#8377 {{ $orderDetails['grand_total'] }}</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <span class="me-2">Coupon Discount:</span>
                  <span class="text-end fw-medium">
                    {{ $orderDetails['coupon_amount'] }}
                  </span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <span class="me-2">Delivery:</span><span class="text-end fw-medium">
                  {{ $orderDetails['shipping_charges'] }}
                  </span>
                </li>
              </ul>

              </div>
            </div>

          </div>
        </div>
      </aside>
    </div>
  </div>

@endsection    