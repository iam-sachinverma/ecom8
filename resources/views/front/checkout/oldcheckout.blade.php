@extends('layouts.front_layout.front_layout')
@section('content')

<main class="app-content bg-light">

  @if(Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ Session::get('error_message')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php Session::forget('error_message'); ?>
  @endif

  	<h1 style="font-size: 22px" class="p-3">Select Payment Option</h1>

    <form action="{{ url('/checkout') }}" method="post" name="checkoutForm" id="checkoutForm" autocomplete="off">@csrf

    <section class="mx-2 my-2 p-2 mb-shadow-sm bg-body rounded">
     
      <div class="form-check" id="codMethod">
        <input class="form-check-input" type="radio" name="payment_gateway" id="COD" value="COD">
        <label class="form-check-label" for="COD">
          Cash On Delivery
        </label>
      </div>

      <div class="form-check" id="prepaidMethod">
        <input class="form-check-input" type="radio" name="payment_gateway" id="RAZORPAY" value="RAZORPAY">
        <label class="form-check-label" for="RAZORPAY">
          Pay Now
        </label>
      </div>
    
    </section>
  
    <h1 style="font-size: 22px" class="p-3">Select Delivery Address</h1>

    <section class="mx-2 p-2 shadow-sm bg-body rounded">
      <div class="accordion accordion-flush" id="deliveryAccordion">
      
        @foreach($deliveryAddresses as $address)
          <div class="accordion-item">
              <div class="accordion-header" id="header{{ $address['id'] }}">
                <label class="d-flex py-3" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $address['id'] }}" aria-expanded="false" aria-controls="flush-collapse{{ $address['id'] }}">
                
                  <div class="d-flex align-content-center flex-wrap">
                   <input class="form-check-input mx-2" type="radio" value="{{ $address['id'] }}" 
                    shipping_charges="{{ $address['shipping_charges'] }}" total_price="{{ $total_price }}" coupon_amount="{{ Session::get('couponAmount') }}"
                    name="address_id" id="address{{ $address['id'] }}" cod="{{ $address['cod'] }}" >
                  </div>
                  
                  <p class="mx-2 lh-base"><strong>{{ $address['name'] }}</strong><br>
                      {{ $address['address'] }} ,<br> {{ $address['area'] }} ,<br> {{ $address['state'] }}-{{ $address['pincode'] }}<br>
                      Phone number: {{ $address['mobile'] }}
                  </p>

                </label>

              </div>
              <div id="flush-collapse{{ $address['id'] }}" class="accordion-collapse collapse" aria-labelledby="header{{ $address['id'] }}" data-bs-parent="#deliveryAccordion">
                <div class="accordion-body">
                  
                  <div class="d-grid gap-2 my-2">
                    <button href="{{ url('checkout') }}" form="checkoutForm" type="submit" class="btn btn-info my-2">Deliver to this address</button>

                    <a href="" class="btn btn-sm btn-secondary py-1 mt-1" type="button">
                        Edit address
                    </a>
                    <a href="" class="btn btn-sm btn-secondary py-1" type="button">
                      Add delivery instructions
                    </a>
                  </div>

                </div>
              </div>
          </div>
        @endforeach
            
      </div>
    </section>	

  </form>  

	<section class="mx-2 my-2 p-2 mb-shadow-sm bg-body rounded">
		<div class="d-flex">
			<a href="{{ url('/add-edit-delivery-address') }}">
			 <p class="text-start">Add a new address</p>
			</a>
		</div>
	</section>


</main> <!-- app-content.// -->

@endsection