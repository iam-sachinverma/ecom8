@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm">
		
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

</header> 

<main class="app-content">


    @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
            <strong>{{ Session::get('error_message')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php Session::forget('error_message'); ?>
    @endif

    <div class="totalCartItems">  {{ totalCartItems() }} </div>
 
    <div class="AppendCartItems">
     @include('front.products.cart_items')
    </div>

    <hr class="divider">

    {{-- <h6 class="title-section my-2" style="font-size: 17px;">Add Coupon : </h6> --}}

    {{-- <section class="px-2">        
        <form id="ApplyCoupon" method="POST" action="javascript:void(0);" class="row" @if(Auth::check()) user="1" @endif>@csrf
            &nbsp;&nbsp;
            <div class="col-8">   
            <input type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Enter Coupon Code">
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="w-25 col-3">
                <button type="submit" class="btn w-100 btn-sm btn-primary-light text-center text-white border-0">
                    Apply
                </button>
            </div>
        </form>
        <small class="px-2" id="invalidCoupon" style="color: rgb(236, 93, 93);"></small>
    </section> --}}

    <section class="mt-2">
        
        <p type="button" data-bs-toggle="offcanvas" data-bs-target="#modal_payment" 
        class="mx-3 shadow-sm p-2 mb-5 bg-body rounded" style="text-align:left; font-size: 14px;">
            16 Coupon Available
            <span style="float:right; font-size: 14px;">
                View
            </span>
        </p>
            
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="modal_payment" aria-labelledby="modal_payment">
            <div class="offcanvas-header">
             <h5 class="offcanvas-title"> Credit card </h5>
             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0">
                <form id="ApplyCoupon" method="POST" action="javascript:void(0);" class="row" @if(Auth::check()) user="1" @endif>@csrf
                    &nbsp;&nbsp;
                    <div class="col-8">   
                    <input type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Enter Coupon Code">
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="w-25 col-3">
                        <button type="submit" class="btn w-100 btn-sm btn-primary-light text-center text-white border-0">
                            Apply
                        </button>
                    </div>

                    <small class="px-2" id="invalidCoupon" style="color: rgb(236, 93, 93);"></small>
                </form>
            </div>  <!-- offcanvas-body .// -->
        </div> <!-- offcanvas.// -->
    
    </section>
    
    
    <section class="px-5">
        <div class="d-flex text-muted text-center">
         <img class="img-sm" style="max-width: 10%; height:auto;"  src="{{ asset('images/front_images/c1.png') }}" alt="">
        <p class="" style="font-size: 12px;">
            Safe and secure payments. Easy returns. 100% Authentic products. 
        </p>
    </div>
    </section>

    <nav class="bar-bottom">
    {{-- <a href="#price_details" class="text-dark"><p class="ms-2">Rs  {{ $total_price }} <br> <span style="color: green;">You Saved &#8377 {{$total_save }}</span> </p></a> --}}
    <div class="ms-auto me-2"> 
        <a href="{{ url('checkout') }}" class="btn btn-primary">Proceed to buy (<span class="totalCartItems"> {{ totalCartItems() }} </span>) </a>
    </div>
    </nav> <!-- nav-bottom -->
       

</main> 





@endsection