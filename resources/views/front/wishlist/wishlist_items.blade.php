@foreach($userWishlistItems as $item)

<div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
    <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
        <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ url('product/'.$item['product']['id']) }}" style="width: 10rem;">
         <img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt="Product">
        </a>
     <div class="pt-2">
            <h3 class="product-title fs-base mb-2">
             <a target="_blank" href="{{ url('product/'.$item['product']['id']) }}">
                 {{ $item['product']['product_name'] }}
             </a>
            </h3>
         <div class="fs-sm"><span class="text-muted me-2">Brand:</span>Tommy Hilfiger</div>
         <!-- <div class="fs-lg text-accent pt-2">$79.<small>50</small></div> -->
         @if( getDiscountedPrice($item['product']['id']) >0)
		 <span class="text-accent fs-lg me-1">₹{{ getDiscountedPrice($item['product']['id']) }}</span>
		 	<small class="text-muted">
		 	<del class="fs-sm text-muted">MRP: ₹{{ $item['product']['product_price'] }}</del>
		 	</small>
		 @else
		 	<span class="text-accent fs-lg">₹{{ $item['product']['product_price'] }}</span>
		 @endif 
		 <span class="bg-faded-accent text-success rounded-1 mb-1 px-2 mx-2">{{ $item['product']['product_discount'] }}% off</span>

         
     </div>
    </div>
    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
        <button class="btn btn-outline-danger btn-sm wishlistItemDelete" data-wishlistid="{{ $item['id'] }}" type="button">
         <i class="ci-trash me-2"></i>Remove
        </button>
    </div>
</div>

@endforeach