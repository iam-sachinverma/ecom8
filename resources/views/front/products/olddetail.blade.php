<?php 
 use App\Models\Wishlist;
?>
@extends('layouts.front_layout.front_layout')
@section('content')

<style>
	.rate {
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px
}

.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 30px;
    font-weight: 300;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}

</style>

<header class="app-header onlight fixed-top shadow-sm"><!--  Remove dark text in i tag  -->

	<a href="02.page-index-b.html#offcanvas_left_123" data-bs-toggle="offcanvas" role="button" class="btn-header">
		<i class="material-icons md-menu text-dark"></i>
	</a>
	
	<h5 class="title-header text-center text-dark">  Details  </h5>
	
	<a href="#" class="btn-header"> 
		<i class="material-icons md-search text-dark"></i> 
	</a>

	<a href="#" class="btn-header"> 
		<i class="material-icons md-share text-dark"></i> 
	</a>

	<a href="{{ url('/cart') }}" class="btn-header"> 
	  <i class="material-icons md-shopping_cart text-dark"></i> 
	</a> 

</header> 

<main class="app-content mt-2">

	<section class="px-2 mb-2">

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
		
		<div class="Detailbrand">
			<span class="brand badge bg-info bg-gradient mb-1 rounded-0">{{ $productDetails['brand']['name'] }}</span>
		</div>
		<div class="Detailname">
			<h1 class="fs-5 fw-normal">{{ $productDetails['product_name'] }}</h1>
			<!-- Average Rating -->
			@if($avgStarRating>0)
			 <div>
				<?php
				$count=1;
				while($count<=$avgRating) { ?>
					<span>	&#11088;</span>
				<?php $count++; } ?> <small class="text-muted ">({{$avgRating }})</small>  
			 </div>
			@endif	
		</div>
		<div class="price-wrap">
			<span class="h6 getAttrPrice fs-5">
				@if( getDiscountedPrice($productDetails['id']) >0)  
				&#x20B9; {{ getDiscountedPrice($productDetails['id']) }}&nbsp; <span style="font-size: 0.860em;">MRP:</span>&nbsp;<del style="font-size: 0.875em;">&#8377; {{ $productDetails['product_price'] }}</del>
				@else	
					MRP:&nbsp;&nbsp;Rs {{ $productDetails['product_price'] }}
				@endif	
				&nbsp;&nbsp;
				@if( $productDetails['product_discount'] >  0 )
				 <code>Save {{ $productDetails['product_price'] - getDiscountedPrice($productDetails['id']) }}  </code>
				@endif 
			</span> 
			<br><small id="main_image" class="form-text text-muted" style="font-size: 10px;">
				(Inclusive of all taxes)
			</small>
		</div> <!-- price-wrap.// -->
	</section>
	
	<section class="gallery-wrap">
		<div class="main_image px-1">
		 <a href="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" data-fancybox="gallery" class="img-big-wrap"><img src="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}"></a>
	    </div>
		<div class="px-2 mt-2 thumbs-wrap scroll-horizontal text-center">
			@foreach($productDetails['images'] as $image)
			  <a href="{{ asset('images/product_images/large/'.$image['image']) }}" data-fancybox="gallery" class="item-thumb"> <img src="{{ asset('images/product_images/small/'.$image['image']) }}"></a>
			@endforeach
		</div>
	</section>

	<section class="detailAttr mx-3 mt-2">
		<h6>Pack Sizes</h6>
		<form action="{{ url('add-to-cart') }}" method="post" id="addCart">@csrf
			<input type="hidden" name="product_id" id="product_id" value="{{ $productDetails['id'] }}">
				<select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
					@foreach( $productDetails['attributes'] as $attribute)
						<option value="{{ $attribute['size'] }}">{{ $attribute['size'] }} </option>
					@endforeach
				</select>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">QTY</span>
					<input type="number" name="quantity" min="1" class="form-control" placeholder="Quantity" aria-label="quantity" aria-describedby="basic-addon1">
				</div>
				<br>
				<strong>Delivery</strong>
				<div class="input-group input-group-sm mb-2">
    				<input type="text" name="checkPincode" class="form-control rounded-0 border-top-0 border-start-0" id="checkPincode" placeholder="Check Delivery Pincode">
					<button type="button" id="checkPincodeButton" class="btn btn-outline-secondary rounded-0">Go</button>
				</div>
		</form>
	</section>

    <hr class="divider">

	<div class="detailDeliveryTime text-start px-3 my-1">
		<img src="{{ asset('images/front_images/fast-delivery.png') }}">&nbsp;&nbsp;&nbsp;<span class="fw-normal" style="font-size: 13px;">Standard : &nbsp;Today&nbsp;&nbsp;9:00AM - 11:00AM</span>
	</div>

	<hr class="divider">

	<section class="productAbout">
		<div class="product_name px-3 my-2">
			<h2 class="fs-4 fw-normal">{{ $productDetails['product_name'] }}</h2>
		</div>

        <div style="border-bottom: 1.3px solid #eee;"></div>

		<div class="accordion accordion-flush my-2" id="accordionAboutProduct">
			<div class="accordion-item">
			  <h2 class="accordion-header" id="aboutTheProduct">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
				  About The Product
				</button>
			  </h2>
			  <div id="flush-collapseOne" class="accordion-collapse collapse-show" aria-labelledby="aboutTheProduct" data-bs-parent="#accordionAboutProduct">
				<div class="accordion-body"><code>.accordion-flush</code>
				 {{ $productDetails['description'] }}
				</div>
			  </div>
			</div>
			<div class="accordion-item">
			  <h2 class="accordion-header" id="productIngredients">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
				  Ingredients
				</button>
			  </h2>
			  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="productIngredients" data-bs-parent="#accordionAboutProduct">
				<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
			  </div>
			</div>
			<div class="accordion-item">
			  <h2 class="accordion-header" id="productHowToUse">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
				  How To Use
				</button>
			  </h2>
			  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="productHowToUse" data-bs-parent="#accordionAboutProduct">
				<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
			  </div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="productOtherInfo">
				  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
					Other Product Info
				  </button>
				</h2>
				<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="productOtherInfo" data-bs-parent="#accordionAboutProduct">
				  <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
				</div>
			</div>
		</div>

	</section>

	<hr class="divider">

	<section class="rating_and_review mt-2">
		<div class="accordion" id="accordionExample">
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Rating and Review
				</button>
				</h2>
				<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<!-- Rating Form -->
					<form method="post" action="{{ url('/add-rating') }}" name="ratingForm" id="ratingForm">@csrf 
						<input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
					    <div class="rating"> 
				          <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
				          <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
				          <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
				          <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
				          <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> 
		            	</div>

						<div class="form-group">
							<label for="review">Your Review</label>
							<textarea name="review" id="review" require></textarea>
						</div>
						<div>&nbsp;</div>
						<div class="form-group">
							<input type="submit" name="submit">
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>

		<figure class="figure">
		 <h5>User Review</h5>
         @if(count($ratings)>0)
		  @foreach($ratings as $rating)
		    <div>
			 <?php
              $count=1;
			  while($count<=$rating['rating']) { ?>
                <span>	&#11088;</span>
			  <?php $count++; } ?>
			 <p> {{ $rating['review'] }}</p>
             <p>by {{ $rating['user']['name'] }} </p>
			 <p>on {{ date('d-M-Y', strtotime($rating['created_at'])) }}</p>
			</div>
          @endforeach
		 @else
           No reviews available
		 @endif
		</figure>
	</section>

	<section class="similarProduct">
		<h5 class="title-section">You might also like</h5>
		<div class="p-3 scroll-horizontal">
			@foreach($relatedProducts as $product)
				<div class="item">
					<div class="product">
						<a href="{{ url('product/'.$product['id']) }}" class="img-wrap rounded-0">
							@if(isset($product['main_image']))
							 <?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
							@else
							 <?php $product_image_path = ''; ?>
							@endif
							@if(!empty($product['main_image']) && file_exists($product_image_path))
							 <img src="{{ asset($product_image_path) }}" alt="">
							@else
							 <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
							@endif 
						</a>	
						<div class="p-2 text-wrap" style="border: 1px solid #eee; border-top: none;">
							
							<p class="title brand my-1" style="font-weight: 450;font-size: 13px;">{{ $product['brand']['name'] }}</p>
							<p class="title mb-2" style="font-weight: 410; font-size: 16px;">{{ $product['product_name'] }}</p>
							
							
							@if( getDiscountedPrice($product['id'] ) > 0)
							    ₹{{ getDiscountedPrice($product['id'] ) }}&nbsp;&nbsp;<small class="text-muted"><del>₹{{ $product['product_price'] }}</del></small>
							@else
								₹{{ $product['product_price'] }}
							@endif 
							
							{{-- <div class="price my-2" style="font-weight: 550; font-size: 15px;">Rs {{ $product['product_price'] }}</div> <!-- price .// --> --}}
						
							<div class="d-grid gap-2">
								<button class="btn btn-primary btn-sm my-2" type="button">Cart</button>
							</div>

						</div>
					</div>
				</div>
			@endforeach
		</div>  <!-- scroll-horizontal.// -->
	</section>

	<hr class="divider">

	<section class="otherDetailInfo">
		<h5 class="title-section my-2">More Information</h5>

		<div style="border-bottom: 1.5px solid #eee;"></div>

		<div class="info my-2 mb-4">	
			<nav style="--bs-breadcrumb-divider: '>'; margin-left: 1.3rem; " aria-label="breadcrumb">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				  <li class="breadcrumb-item"><a href="{{ url('/'.$productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a></li>
				  <li class="breadcrumb-item active" aria-current="page">{{ $productDetails['product_name'] }}</li>
				</ol>
			</nav>
		</div>	
	</section>

</main>


<nav class="bar-bottom"> 
	
    <div class="flex-grow-1 me-2"> 
		<button class="btn btn-primary" form="addCart">Add to cart</button>
	</div>

    @php $countWishlist = 0; @endphp
	@if(Auth::check())
      @php $countWishlist = Wishlist::countWishlist($productDetails['id']) @endphp	
	  <div> 	
	    <button class="btn btn-light btn-icon updateWishlist" data-productid="{{ $productDetails['id'] }}"> 
		 <i class="@if($countWishlist>0) bi bi-heart-fill @else bi bi-heart @endif"></i>  
	    </button> 
      </div>
	@else
	<div> 	
	 <a href="#" class="btn btn-light btn-icon userLogin"> 
		<i class="material-icons md-favorite_border"></i> 
	 </a> 
    </div>
	@endif
    
</nav> <!-- nav-bottom -->


@endsection