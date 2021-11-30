<?php use App\Models\Product; ?>

<div class="row">

    <!-- List of items-->
    <section class="col-lg-8">

        <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
            
            <h2 class="h6 text-light mb-0">
                @if ( totalCartItems() == 1  ) 
                {{ totalCartItems() }} Product
                @else 
                {{ totalCartItems() }} Products
                @endif 
            </h2>
            
            <a class="btn btn-outline-primary btn-sm ps-2" href="{{ url('/') }}">
                <i class="ci-arrow-left me-2"></i>Continue shopping
            </a>
        </div>

        <!--  PHP  -->
        <?php $total_price = 0; ?>
        <?php $total_mrp_price = 0; ?>
        <?php $total_discount = 0; ?>

        @foreach($userCartItems as $item)

        <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
        <!--  Total Product Final AttributePrice -->
        <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
        <!--  Total Product MRP Price with quantity -->
        <?php $total_mrp_price = $total_mrp_price + ($attrPrice['product_price'] * $item['quantity']); ?>
        <!--  Total Discount with quantity  -->
        <?php $total_discount = $total_discount + ($attrPrice['save'] * $item['quantity']); ?>


        <!-- Item-->
        <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
            <div class="d-block d-sm-flex align-items-center text-center text-sm-start">
                <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="{{ url('product/'.$item['product']['id']) }}">
                    <img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" width="160" alt="Product">
                </a>
                <div class="pt-2">
                    <h3 class="product-title fs-base mb-2">
                        <a href="{{ url('product/'.$item['product']['id']) }}">
                        {{ $item['product']['product_name'] }}
                        </a>
                    </h3>
                    <div class="fs-sm">
                        <span class="text-muted me-2">Size:</span>{{ $item['size'] }}
                    </div>

                    @if( $attrPrice['attribute_discount'] > 0 )
                    <span class="fs-lg text-accent pt-2">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }}</span>
                    <span> 
                        <del class="fs-lg text-muted"><small> &#8377 {{ $attrPrice['product_price'] * $item['quantity'] }} </small></del>
                    </span>                  
                    <span class="badge bg-success fw-normal rounded-2 mx-1">{{ $attrPrice['attribute_discount']  }} &#37; off</span>
                    @else
                    <span class="fs-lg text-accent pt-2">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }}</span>
                    @endif

                </div>
            </div>
            <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
             <label class="form-label" for="quantity1">Quantity</label>
  
             <!-- <input class="form-control" type="number" id="quantity" min="1" value="1"> -->
             <div class="input-group input-group-sm input-spinner">
                <button class="btn btn-light border btnItemUpdate qtyMinus" type="button" data-cartid="{{ $item['id'] }}" > <i class="bi bi-dash-lg"></i> </button>
                <input type="text" class="form-control" min="1" id="quantity" value="{{ $item['quantity'] }}">
                <button class="btn btn-light border btnItemUpdate qtyPlus" type="button" data-cartid="{{ $item['id'] }}" > <i class="bi bi-plus-lg"></i> </button>
             </div>

                <button class="btn btn-link px-0 text-danger btnItemDelete" type="button" data-cartid="{{ $item['id'] }}">
                 <i class="ci-close-circle me-2"></i>
                 <span class="fs-sm">Remove</span>
                </button>
            </div>
        </div>


        @endforeach


    </section>

    <!-- Sidebar-->
    <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
        <div class="bg-white rounded-3 shadow-lg p-4">
            <div class="py-2 px-xl-2">

                <ul class="list-unstyled fs-sm pb-2 border-bottom">
                    <li class="d-flex justify-content-between align-items-center">
                        <span class="me-2">Price ( 
                        @if ( totalCartItems() == 1  ) 
                        {{ totalCartItems() }} item
                        @else 
                        {{ totalCartItems() }} items
                        @endif )
                        </span>
                        <span class="text-end">&#8377 {{ $total_mrp_price }} </span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                        <span class="me-2">Discount:</span><span class="text-end" style="color:green">&#8722 &#8377 {{ $total_discount }} </span>
                    </li>
                    <div id="couponRow" style="display: none;">
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">Coupon Discount:</span>
                            <span class="text-end">&#8377 <span class="couponAmount">  </span></span>
                        </li>
                    </div>    
                </ul>
                
                <div class="text-center mb-4 pb-3 border-bottom">
                    <h2 class="h6 mb-3 pb-1">Subtotal</h2>
                    <h3 class="fw-normal grand_total">&#8377 {{ $total_price - Session::get('couponAmount') }}</h3>
                    <?php $grand_total = $total_price - Session::get('couponAmount');
                    Session::put('grand_total',$grand_total); ?>
                </div>
                
                <div class="accordion" id="order-options">
                
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <a class="accordion-button" href="#promo-code" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="promo-code">Apply promo code</a>
                        </h3>
                        <div class="accordion-collapse collapse show" id="promo-code" data-bs-parent="#order-options">
                            
                            <form id="ApplyCoupon" method="POST" action="javascript:void(0);" class="accordion-body" @if(Auth::check()) user="1" @endif>@csrf
                            
                                <div class="mb-3">   
                                  <input type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Enter Coupon Code">
                                </div>
                                
                                <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo code</button>

                                <small class="px-2" id="invalidCoupon" style="color: rgb(236, 93, 93);"></small>
                            </form>

                        </div>
                    </div>
                
                </div>

                <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="{{ url('checkout') }}">
                 <i class="ci-card fs-lg me-2"></i>Proceed to Checkout
                </a>
                
            </div>
        </div>
    </aside>

</div>