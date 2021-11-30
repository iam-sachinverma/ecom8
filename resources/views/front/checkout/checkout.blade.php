<?php use App\Models\Product; ?>


@extends('layouts.front_layout.front_layout')
@section('content')

<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
          <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
          <li class="breadcrumb-item text-nowrap"><a href="marketplace-category.html">Market</a>
          </li>
          <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
        </ol>
      </nav>
    </div>
    <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
      <h1 class="h3 text-light mb-0">Checkout</h1>
    </div>
  </div>
</div>

<div class="container pb-5 mb-2 mb-md-4">


  @if(Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ Session::get('error_message')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php Session::forget('error_message'); ?>
  @endif
  
  <form action="{{ url('/checkout') }}" method="post" name="checkoutForm" id="checkoutForm" autocomplete="off">@csrf
  
  <div class="row">

      <section class="col-lg-8">

        <!-- Steps-->
        <div class="steps steps-light pt-2 pb-3 mb-5">
          <a class="step-item active" href="shop-cart.html">
            <div class="step-progress">
            <span class="step-count">1</span>
            </div>
            <div class="step-label">
              <i class="ci-cart"></i>Cart
            </div>
          </a>
        
          <a class="step-item active current" href="checkout-review.html">
          <div class="step-progress"><span class="step-count">2</span></div>
          <div class="step-label"><i class="ci-check-circle"></i>Checkout</div></a>
        </div>
      
        <h2 class="h6 pb-3 mb-2">Choose shipping method</h2>
        <div class="table-responsive">
          <table class="table table-hover fs-sm border-top">
            <thead>
              <tr>
                <th class="align-middle">Delivery Address</th>
                <th class="align-middle">Delivery time</th>
                <th class="align-middle">Shipping Charges</th>
              </tr>
            </thead>
            <tbody>
            @foreach($deliveryAddresses as $address)
              <tr>
                <td>
                  <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" value="{{ $address['id'] }}" 
                    shipping_charges="{{ $address['shipping_charges'] }}" total_price="{{ $total_price }}" coupon_amount="{{ Session::get('couponAmount') }}"
                    name="address_id" id="address{{ $address['id'] }}" cod="{{ $address['cod'] }}" >
                  
                    <label class="form-check-label" for="address{{ $address['id'] }}">{{ $address['name'] }} 
                    <br>{{ $address['address'] }} ,<br> {{ $address['area'] }} ,<br> {{ $address['state'] }}-{{ $address['pincode'] }}<br>
                    Phone number: {{ $address['mobile'] }}
                    </label>
                  </div>
                </td>
                <td class="align-middle">2 - 4 days</td>
                <td class="align-middle shipping_charges">0</td>
              </tr>
            @endforeach        
            </tbody>
          </table>
        </div>
      
      </section>

      <!-- Sidebar-->
      <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
        <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
          <h2 class="h5 pb-3">Your order</h2>
          
          @foreach($userCartItems as $item)

          <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
          <!--  Total Product Final AttributePrice -->
        

          <div class="d-flex align-items-center pb-2 border-bottom">
            <a class="d-block flex-shrink-0" href="grocery-single.html">
              <img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" width="64" alt="Product">
            </a>
            <div class="ps-2">
              <h6 class="widget-product-title">
                <a href="grocery-single.html">{{ $item['product']['product_name'] }}</a>
              </h6>
              <div class="widget-product-meta">
                <span class="text-accent me-1 ">{{ $attrPrice['final_price'] }}</span>
                <!-- <span class="text-muted">x {{ $item['quantity'] }}</span> -->
                <span class="text-muted">x {{ $item['quantity'] }}</span>
              </div>
            </div>
          </div>

          @endforeach
          
          <ul class="list-unstyled fs-sm pt-4 pb-2 border-bottom">
            <li class="d-flex justify-content-between align-items-center">
              <span class="me-2">Subtotal:</span>
              <span class="text-end fw-medium">&#8377 {{ $total_price }}</span>
            </li>
            <li class="d-flex justify-content-between align-items-center">
              <span class="me-2">Coupon Discount:</span>
              <span class="text-end fw-medium">
                @if(Session::has('couponAmount'))
                &#8377  {{ Session::get('couponAmount') }}
                @else
                &#8377  0
                @endif
              </span>
            </li>
            <li class="d-flex justify-content-between align-items-center">
              <span class="me-2">Delivery:</span><span class="text-end fw-medium shipping_charges">0</span>
            </li>
          </ul>

          <h3 class="fw-normal text-center my-4 py-2 grand_total">&#8377 {{ $total_price }}</h3>

          <div class="accordion accordio-flush shadow-sm rounded-3 mb-4" id="payment-methods">
            
            <div class="accordion-item border-bottom">
              <div class="accordion-header py-3 px-3">
                <div class="form-check d-table" data-bs-toggle="collapse" data-bs-target="#payment-online">
                 <input class="form-check-input" type="radio" name="payment_gateway" id="payment-online" value="RAZORPAY">
                  
                  <label class="form-check-label fw-medium text-dark" for="payment-online">Paynow<i class="ci-wallet text-muted fs-lg align-middle mt-n1 ms-2"></i></label>
                </div>
              </div>
              <div class="collapse" id="payment-online" data-bs-parent="#payment-methods">
                <div class="accordion-body pt-2">
                  <p class="fs-sm mb-0">Online payment not avaiable right now</p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <div class="accordion-header py-3 px-3">
                <div class="form-check d-table" data-bs-toggle="collapse" data-bs-target="#payment-cash">
                  <input class="form-check-input" type="radio" name="payment_gateway" id="payment-cash" value="COD"> 
                  <label class="form-check-label fw-medium text-dark" for="payment-cash">Cash on delivery<i class="ci-wallet text-muted fs-lg align-middle mt-n1 ms-2"></i></label>
                </div>
              </div>
              <div class="collapse" id="payment-cash" data-bs-parent="#payment-methods">
                <div class="accordion-body pt-2">
                  <p class="fs-sm mb-0">I will pay with cash to the courier on delivery.</p>
                </div>
              </div>
            </div>

          </div>

          <div class="pt-2">
            <button class="btn btn-primary d-block w-100" type="submit">Place Order</button>
          </div>

        </div>
      </aside>


  </div>

  </form>

</div>


@endsection