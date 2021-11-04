<?php use App\Models\Product; ?>
   
    <section class="px-3" id="cartItems">
      {{-- PHP --}}
      <?php $total_price = 0; ?>
      <?php $total_mrp_price = 0; ?>
      <?php $total_discount = 0; ?>
      

        @foreach($userCartItems as $item)

            <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
            {{-- Total Product Final AttributePrice --}}
            <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
            {{-- Total Product MRP Price with quantity--}}
            <?php $total_mrp_price = $total_mrp_price + ($attrPrice['product_price'] * $item['quantity']); ?>
            {{-- Total Discount with quantity --}}
            <?php $total_discount = $total_discount + ($attrPrice['save'] * $item['quantity']); ?>
            

                <article class="item-cart">
                   <figure class="itemside mb-3">
                       <a href="{{ url('product/'.$item['product']['id']) }}"><div class="aside"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" class="rounded border img-md"></div></a>
                       
                       <figcaption class="info">
                           <a href="{{ url('product/'.$item['product']['id']) }}" class="title text-truncate" style="font-size: 14px;">{{ $item['product']['product_name'] }} </a>
                            <small class="text-muted"> 

                               Pack Size: {{ $item['size'] }}   <br> 
                               @if( $attrPrice['attribute_discount'] > 0 )
                                <span class="text-dark">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }} &nbsp;</span>
                                <del> &#8377 {{ $attrPrice['product_price'] * $item['quantity'] }} </del>&nbsp;&nbsp;
                                <span class="badge bg-success fw-normal rounded-2">{{ $attrPrice['attribute_discount']  }} &#37; off</span>
                               @else 
                                <span class="text-dark">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }} &nbsp;</span>
                               @endif
                                
                            </small>
                       </figcaption>
                   </figure>
           
                    <div class="row align-items-center">
                       <div class="col">
                           <div class="input-group input-group-sm input-spinner">
                               <button class="btn btn-light btnItemUpdate qtyMinus py-0" type="button" data-cartid="{{ $item['id'] }}" > <i class="material-icons md-minus"></i> </button>
                               <input type="text" class="form-control py-0" value="{{ $item['quantity'] }}">
                               <button class="btn btn-light btnItemUpdate qtyPlus py-0" type="button" data-cartid="{{ $item['id'] }}" > <i class="material-icons md-plus"></i> </button>
                           </div> <!-- input-group.// -->
                       </div>

                       <div class="col"> 
                           <button  class="btn btn-outline-danger btn-sm btnItemDelete py-0" data-cartid="{{ $item['id'] }}"> Delete </button> 
                       </div>
                       <div class="col"> 
                        <button  class="btn btn-sm btn-outline-secondary btnItemSavelater py-0" data-cartid="{{ $item['id'] }}"> Save for later</button> 
                       </div>
                    </div>
                </article> <!-- item-cart.// -->

           <hr>
        @endforeach  
    </section> <!-- section cart items .// -->


    {{-- <section class="p-3" id="cartItems">
       <div class="row">
        @foreach($userCartItems as $item)
           <div class="col-12 col-sm-12 col-md-6 my-2">

            <div class="product-list">
                <a href="{{ url('product/'.$item['product']['id']) }}" class="img-wrap">
                    <img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}">
                </a>
                <div class="info-wrap">
                    
                    <a href="{{ url('product/'.$item['product']['id']) }}" class="title text-truncate px-2" style="font-size: 14px;">{{ $item['product']['product_name'] }} </a>

                    <small class="text-muted px-2"> 

                        Pack Size: {{ $item['size'] }}   <br> 
                        @if( $attrPrice['attribute_discount'] > 0 )
                         <span class="text-dark px-2">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }} &nbsp;</span>
                         <del> &#8377 {{ $attrPrice['product_price'] * $item['quantity'] }} </del>&nbsp;&nbsp;
                         <span class="badge bg-success fw-normal rounded-2">{{ $attrPrice['attribute_discount']  }} &#37; off</span>
                        @else 
                         <span class="text-dark">&#8377 {{ $attrPrice['final_price'] * $item['quantity'] }} &nbsp;</span>
                        @endif
                         
                    </small>

                    <div class="input-group input-group-sm input-spinner">
                        <button class="btn btn-light btnItemUpdate qtyMinus py-0 border-0" type="button" data-cartid="{{ $item['id'] }}" > <i class="material-icons md-minus"></i> </button>
                        <input type="text" class="form-control py-0 bg-white text-dark border-0" value="{{ $item['quantity'] }}" readonly>
                        <button class="btn btn-light btnItemUpdate qtyPlus py-0 border-0" type="button" data-cartid="{{ $item['id'] }}" > <i class="material-icons md-plus"></i> </button>
                    </div> <!-- input-group.// -->
                </div>
            </div>
            
           </div>
        @endforeach   
        </div>  
    </section> --}}
    
    <hr class="divider">

    {{-- <section class="p-3">
       <a href="" class="text-dark">
        <h5 >No-Contact Delivery</h5>
        <div class="guidelines d-flex ">
           <p style="font-size: 0.9rem;">
            Delivery Associate will place the order on your doorstep and step back to maintain a 2-meter distance.
           </p>
           <div class="img-icon">
            <img  class="" style="height: 4rem;" src="images/front_images/delivery.png" alt="">
           </div> 
        </div>
       </a> 
    </section> --}}

    <h6 class="title-section my-2" style="font-size: 14px;">PRICE DETAILS</h6>

    <div style="border-bottom: 1.3px solid #eee;"></div>

    <section class="padding-around" id="price_details" style="font-size: 13px;">
        <dl class="dlist-align">
            <dt class="text-muted">
                Price  @if ( totalCartItems() == 1  ) 
                  {{ totalCartItems() }} item
                 @else 
                  {{ totalCartItems() }} items
                 @endif
            </dt>
            <dd class="text-end">&#8377 {{ $total_mrp_price }}</dd>
        </dl>

        <dl class="dlist-align">
            <dt class="text-muted">Discount</dt>
            <dd class="text-end"><span style="color:green"> &#8722 &#8377 {{ $total_discount }} </span> </dd>
        </dl>

        <dl class="dlist-align" id="couponRow" style="display: none;">
            <dt class="text-muted">Coupon Discount :</dt>
            <dd class="text-end">&#8377 <span class="couponAmount">  </span> </dd>
        </dl>
           
        <dl class="dlist-align">
            <dt class="text-muted">Shipping:</dt>
            <dd class="text-end">&#8377 10.00</dd>
        </dl>

        <hr>

        <dl class="dlist-align">
            <dt class="text-muted"><strong>Total Amount:</strong></dt>
            <dd class="text-end">&#8377<strong class="grand_total"> {{ $total_price - Session::get('couponAmount') }}</strong></dd>
            <?php $grand_total = $total_price - Session::get('couponAmount');
            Session::put('grand_total',$grand_total); ?>
        </dl>
        
    </section>

    
