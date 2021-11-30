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
	


    <!-- Page Title-->
    <section class="ps-lg-4 pe-lg-3 pt-4">
		<!-- Gallery + details-->
	    <div class="px-3 pt-2">
			<div class="row">
				<!-- Product gallery-->
				<div class="col-lg-7 pe-lg-0 pt-lg-4">
					<div class="product-name-price d-lg-none">
						<a class="product-meta d-block fs-sm pb-2" href="#">{{ $productDetails['brand']['name'] }}</a>
						<h1 class="h2">{{ $productDetails['product_name'] }}</h1> 
						
						<div class="getAttrPrice mb-3">
							@if( getDiscountedPrice($productDetails['id']) >0)  	
							<span class="h3 fw-normal text-accent me-1">&#x20B9;{{ getDiscountedPrice($productDetails['id']) }} &nbsp;<small class="text-muted fs-lg">MRP:</small></span>
							<del class="text-muted fs-lg me-3">&#x20B9;{{ $productDetails['product_price'] }}</del>
							@else
							<span class="h3 fw-normal text-accent me-1">&#x20B9;{{ $productDetails['product_price'] }} </span>
							@endif

							@if( $productDetails['product_discount'] >  0 )
							<span class="badge bg-success badge-shadow align-middle mt-n2 p-1">
							You Save:&nbsp;  &#x20B9;{{ $productDetails['product_price'] - getDiscountedPrice($productDetails['id']) }}
							</span>
							@endif 

						</div>
					</div>   

					<div class="product-gallery">
						<div class="product-gallery-preview order-sm-2">
							<div class="product-gallery-preview-item active" id="{{ $productDetails['product_code'] }}">
								<img class="image-zoom" src="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" data-zoom="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" alt="Product image">
								<div class="image-zoom-pane"></div>
							</div>

							@foreach($productDetails['images'] as $image)
							<div class="product-gallery-preview-item" id="th{{ $image['id'] }}">
								<img class="image-zoom" src="{{ asset('images/product_images/large/'.$image['image']) }}" data-zoom="{{ asset('images/product_images/large/'.$image['image']) }}" alt="Product image">
								<div class="image-zoom-pane"></div>
							</div>
							@endforeach
							
						</div>
						<div class="product-gallery-thumblist order-sm-1">
							<a class="product-gallery-thumblist-item active" href="#{{ $productDetails['product_code'] }}">
								<img src="{{ asset('images/product_images/small/'.$productDetails['main_image']) }}" alt="Product thumb">
							</a>

							@foreach($productDetails['images'] as $image)
							<a class="product-gallery-thumblist-item" href="#th{{ $image['id'] }}">
								<img src="{{ asset('images/product_images/small/'.$image['image']) }}" alt="Product thumb">
							</a>
							@endforeach

							<a class="product-gallery-thumblist-item video-item" href="https://www.youtube.com/watch?v=1vrXpMLLK14">
							<div class="product-gallery-thumblist-item-text"><i class="ci-video"></i>Video</div>
							</a>
						</div>
					</div>
					
				</div>
				<!-- Product details-->
				<div class="col-lg-5 pt-4 pt-lg-0">
					<div class="product-details ms-auto pb-3">
						<div class="d-flex justify-content-between align-items-center mb-3"><a href="#reviews" data-scroll>
							
							<!-- Average Rating -->
							@if($avgStarRating>0)
							<div class="star-rating">
								<?php
								$count=1;
								while($count<=$avgRating) { ?>
									<i class="bi bi-star-fill" style="color: gold;"></i>	
								<?php $count++; } ?>&nbsp;<small class="text-muted ">( {{$avgRating }} )</small>  
							</div>
							@endif	              

							<span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">74 Reviews</span>
							
							@php $countWishlist = 0; @endphp
							@if(Auth::check())
							@php $countWishlist = Wishlist::countWishlist($productDetails['id']) @endphp
							<button class="btn-wishlist me-0 me-lg-n3 updateWishlist" type="button" data-bs-toggle="tooltip" data-productid="{{ $productDetails['id'] }}" 
								title="Add to wishlist">
								<i class="@if($countWishlist>0) bi bi-heart-fill @else bi bi-heart @endif"></i>
							</button>
							@else
							<button class="btn-wishlist me-0 me-lg-n3 userLogin" type="button" data-bs-toggle="tooltip" title="Add to wishlist">
								<i class="bi bi-heart"></i>
							</button>
							@endif
						</div>

						<div class="mb-4 d-none d-lg-block">
							<a class="product-meta d-block fs-sm pb-2" href="#">{{ $productDetails['brand']['name'] }}</a>
							<h1 class="h2">{{ $productDetails['product_name'] }}</h1> 
						
							<div class="getAttrPrice mb-3">
								@if( getDiscountedPrice($productDetails['id']) >0)  	
								<span class="h3 fw-normal text-accent me-1">&#x20B9;{{ getDiscountedPrice($productDetails['id']) }} &nbsp;<small class="text-muted fs-lg">MRP:</small></span>
								<del class="text-muted fs-lg me-3">&#x20B9;{{ $productDetails['product_price'] }}</del>
								@else
								<span class="h3 fw-normal text-accent me-1">&#x20B9;{{ $productDetails['product_price'] }} </span>
								@endif

								@if( $productDetails['product_discount'] >  0 )
								<span class="badge bg-success badge-shadow align-middle mt-n2">
								You Save:&nbsp;  &#x20B9;{{ $productDetails['product_price'] - getDiscountedPrice($productDetails['id']) }}
								</span>
								@endif 
							</div>	
						</div>

						<form class="mb-grid-gutter" action="{{ url('add-to-cart') }}" method="post" id="addCart">@csrf
							<div class="mb-3">
								
								<div class="d-flex justify-content-between align-items-center pb-1">
									<label class="form-label" for="product-size">Size:</label><a class="nav-link-style fs-sm" href="#size-chart" data-bs-toggle="modal"><i class="ci-ruler lead align-middle me-1 mt-n1"></i>Size guide</a>
								</div>
								
								<input type="hidden" name="product_id" id="product_id" value="{{ $productDetails['id'] }}">

								<select class="form-select" name="size" id="getPrice" product-id="{{ $productDetails['id'] }}">
									@foreach( $productDetails['attributes'] as $attribute)
									<option value="{{ $attribute['size'] }}">{{ $attribute['size'] }} </option>
									@endforeach
								</select>

							</div>
							<div class="mb-3 d-flex align-items-center">
								<!-- Quantity -->
								<input type="number" name="quantity" min="1" class="form-control me-3" placeholder="Quantity" aria-label="quantity" aria-describedby="basic-addon1">
							
								<button class="btn btn-primary btn-shadow d-block w-100" form="addCart" type="submit">
								<i class="ci-cart fs-lg me-2"></i>Add to Cart
								</button>
							</div>
						</form>

						<!-- Product panels-->
						<div class="accordion mb-4" id="productPanels">
							<div class="accordion-item">
							<h3 class="accordion-header"><a class="accordion-button" href="#productInfo" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo"><i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Product info</a></h3>
							<div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
								<div class="accordion-body">
								<h6 class="fs-sm mb-2">Composition</h6>
								<ul class="fs-sm ps-4">
									<li>Elastic rib: Cotton 95%, Elastane 5%</li>
									<li>Lining: Cotton 100%</li>
									<li>Cotton 80%, Polyester 20%</li>
								</ul>
								<h6 class="fs-sm mb-2">Art. No.</h6>
								<ul class="fs-sm ps-4 mb-0">
									<li>183260098</li>
								</ul>
								</div>
							</div>
							</div>
							<div class="accordion-item">
							<h3 class="accordion-header"><a class="accordion-button collapsed" href="#shippingOptions" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="ci-delivery text-muted lead align-middle mt-n1 me-2"></i>Shipping options</a></h3>
							<div class="accordion-collapse collapse" id="shippingOptions" data-bs-parent="#productPanels">
								<div class="accordion-body fs-sm">
								<div class="d-flex justify-content-between border-bottom pb-2">
									<div>
									<div class="fw-semibold text-dark">Courier</div>
									<div class="fs-sm text-muted">2 - 4 days</div>
									</div>
									<div>$26.50</div>
								</div>
								<div class="d-flex justify-content-between border-bottom py-2">
									<div>
									<div class="fw-semibold text-dark">Local shipping</div>
									<div class="fs-sm text-muted">up to one week</div>
									</div>
									<div>$10.00</div>
								</div>
								<div class="d-flex justify-content-between border-bottom py-2">
									<div>
									<div class="fw-semibold text-dark">Flat rate</div>
									<div class="fs-sm text-muted">5 - 7 days</div>
									</div>
									<div>$33.85</div>
								</div>
								<div class="d-flex justify-content-between border-bottom py-2">
									<div>
									<div class="fw-semibold text-dark">UPS ground shipping</div>
									<div class="fs-sm text-muted">4 - 6 days</div>
									</div>
									<div>$18.00</div>
								</div>
								<div class="d-flex justify-content-between pt-2">
									<div>
									<div class="fw-semibold text-dark">Local pickup from store</div>
									<div class="fs-sm text-muted">&mdash;</div>
									</div>
									<div>$0.00</div>
								</div>
								</div>
							</div>
							</div>
							<div class="accordion-item">
							<h3 class="accordion-header"><a class="accordion-button collapsed" href="#localStore" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i class="ci-location text-muted fs-lg align-middle mt-n1 me-2"></i>Find in local store</a></h3>
							<div class="accordion-collapse collapse" id="localStore" data-bs-parent="#productPanels">
								<div class="accordion-body">
								<select class="form-select">
									<option value>Select your country</option>
									<option value="Argentina">Argentina</option>
									<option value="Belgium">Belgium</option>
									<option value="France">France</option>
									<option value="Germany">Germany</option>
									<option value="Spain">Spain</option>
									<option value="UK">United Kingdom</option>
									<option value="USA">USA</option>
								</select>
								</div>
							</div>
							</div>
						</div>

						<!-- Sharing-->
						<label class="form-label d-inline-block align-middle my-2 me-3">Share:</label>
						<a class="btn-share btn-twitter me-2 my-2" href="#">
							<i class="ci-twitter"></i>Twitter
						</a>
						<a class="btn-share btn-instagram me-2 my-2" href="#">
							<i class="ci-instagram"></i>Instagram
						</a>
						<a class="btn-share btn-facebook my-2" href="#">
							<i class="ci-facebook"></i>Facebook
						</a>
						
					</div>
				</div>
			</div>
		</div>
	</section>  
	
	<!-- Product carousel (You may also like)-->
	<div class="container-fluid pt-lg-2 pb-5 mb-md-3 bg-secondary">
		<h2 class="h3 text-center pb-3">You may also like</h2>
		<div class="tns-carousel tns-controls-static tns-controls-outside">
		<div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
			<!-- Product-->
			<div>
			@foreach($relatedProducts as $product)
			<div class="card product-card card-static">
				<button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
					<i class="ci-heart"></i>
				</button> 

				<a class="card-img-top d-block overflow-hidden" href="{{ url('product/'.$product['id']) }}">
					@if(isset($product['main_image']))
						<?php $product_image_path = 'images/product_images/large/'.$product['main_image']; ?>
					@else
						<?php $product_image_path = ''; ?>
					@endif
					@if(!empty($product['main_image']) && file_exists($product_image_path))
						<img src="{{ asset($product_image_path) }}" alt="">
					@else
						<img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
					@endif 
				</a>


				<div class="card-body py-2">
					<a class="product-meta d-block fs-xs pb-1" href="#">{{ $product['brand']['name'] }}</a>
					<h3 class="product-title fs-sm">
						<a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a>
					</h3>	

					<div class="d-flex flex-wrap justify-content-between align-items-center">
						<div class="product-price">         
							@if( getDiscountedPrice($product['id']) >0)
							<span class="text-accent fs-lg"> ₹{{ getDiscountedPrice($product['id']) }}</span>
								<small class="text-muted">
								<del class="fs-sm text-muted">₹{{ $product['product_price'] }}</del>
								</small>
							@else
								<span class="text-accent fs-lg">₹{{ $product['product_price'] }}</span>
							@endif 
						</div>
						<div class="bg-faded-accent text-accent rounded-1 mb-1 px-2">{{ $productDetails['product_discount'] }}% off</div>
					</div>
				</div>
			</div>
			@endforeach
			</div>
		</div>
		</div>
	</div>

	<!-- Reviews-->
	<div class="border-top border-bottom my-lg-3 py-5">
		<div class="container pt-md-2" id="reviews">
			<div class="row pb-3">
			<div class="col-lg-4 col-md-5">
				<h2 class="h3 mb-4">74 Reviews</h2>
				<div class="star-rating me-2"><i class="ci-star-filled fs-sm text-accent me-1"></i><i class="ci-star-filled fs-sm text-accent me-1"></i><i class="ci-star-filled fs-sm text-accent me-1"></i><i class="ci-star-filled fs-sm text-accent me-1"></i><i class="ci-star fs-sm text-muted me-1"></i></div><span class="d-inline-block align-middle">4.1 Overall rating</span>
				<p class="pt-3 fs-sm text-muted">58 out of 74 (77%)<br>Customers recommended this product</p>
			</div>
			<div class="col-lg-8 col-md-7">
				<div class="d-flex align-items-center mb-2">
				<div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">5</span><i class="ci-star-filled fs-xs ms-1"></i></div>
				<div class="w-100">
					<div class="progress" style="height: 4px;">
					<div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div><span class="text-muted ms-3">43</span>
				</div>
				<div class="d-flex align-items-center mb-2">
				<div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">4</span><i class="ci-star-filled fs-xs ms-1"></i></div>
				<div class="w-100">
					<div class="progress" style="height: 4px;">
					<div class="progress-bar" role="progressbar" style="width: 27%; background-color: #a7e453;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div><span class="text-muted ms-3">16</span>
				</div>
				<div class="d-flex align-items-center mb-2">
				<div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">3</span><i class="ci-star-filled fs-xs ms-1"></i></div>
				<div class="w-100">
					<div class="progress" style="height: 4px;">
					<div class="progress-bar" role="progressbar" style="width: 17%; background-color: #ffda75;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div><span class="text-muted ms-3">9</span>
				</div>
				<div class="d-flex align-items-center mb-2">
				<div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">2</span><i class="ci-star-filled fs-xs ms-1"></i></div>
				<div class="w-100">
					<div class="progress" style="height: 4px;">
					<div class="progress-bar" role="progressbar" style="width: 9%; background-color: #fea569;" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div><span class="text-muted ms-3">4</span>
				</div>
				<div class="d-flex align-items-center">
				<div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">1</span><i class="ci-star-filled fs-xs ms-1"></i></div>
				<div class="w-100">
					<div class="progress" style="height: 4px;">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 4%;" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div><span class="text-muted ms-3">2</span>
				</div>
			</div>
			</div>
			<hr class="mt-4 mb-3">
			<div class="row pt-4">
			<!-- Reviews list-->
			<div class="col-md-7">
				<div class="d-flex justify-content-end pb-4">
				<div class="d-flex align-items-center flex-nowrap">
					<label class="fs-sm text-muted text-nowrap me-2 d-none d-sm-block" for="sort-reviews">Sort by:</label>
					<select class="form-select form-select-sm" id="sort-reviews">
					<option>Newest</option>
					<option>Oldest</option>
					<option>Popular</option>
					<option>High rating</option>
					<option>Low rating</option>
					</select>
				</div>
				</div>
				<!-- Review-->
				<div class="product-review pb-4 mb-4 border-bottom">
				<div class="d-flex mb-3">
					<div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/01.jpg" width="50" alt="Rafael Marquez">
					<div class="ps-3">
						<h6 class="fs-sm mb-0">Rafael Marquez</h6><span class="fs-ms text-muted">June 28, 2019</span>
					</div>
					</div>
					<div>
					<div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
					</div>
					<div class="fs-ms text-muted">83% of users found this review helpful</div>
					</div>
				</div>
				<p class="fs-md mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est...</p>
				<ul class="list-unstyled fs-ms pt-1">
					<li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
					<li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
				</ul>
				<div class="text-nowrap">
					<button class="btn-like" type="button">15</button>
					<button class="btn-dislike" type="button">3</button>
				</div>
				</div>
				<!-- Review-->
				<div class="product-review pb-4 mb-4 border-bottom">
				<div class="d-flex mb-3">
					<div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/02.jpg" width="50" alt="Barbara Palson">
					<div class="ps-3">
						<h6 class="fs-sm mb-0">Barbara Palson</h6><span class="fs-ms text-muted">May 17, 2019</span>
					</div>
					</div>
					<div>
					<div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
					</div>
					<div class="fs-ms text-muted">99% of users found this review helpful</div>
					</div>
				</div>
				<p class="fs-md mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<ul class="list-unstyled fs-ms pt-1">
					<li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
					<li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
				</ul>
				<div class="text-nowrap">
					<button class="btn-like" type="button">34</button>
					<button class="btn-dislike" type="button">1</button>
				</div>
				</div>
				<!-- Review-->
				<div class="product-review pb-4 mb-4 border-bottom">
				<div class="d-flex mb-3">
					<div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/03.jpg" width="50" alt="Daniel Adams">
					<div class="ps-3">
						<h6 class="fs-sm mb-0">Daniel Adams</h6><span class="fs-ms text-muted">May 8, 2019</span>
					</div>
					</div>
					<div>
					<div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
					</div>
					<div class="fs-ms text-muted">75% of users found this review helpful</div>
					</div>
				</div>
				<p class="fs-md mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.</p>
				<ul class="list-unstyled fs-ms pt-1">
					<li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi</li>
					<li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae,  quis autem, voluptatem sequ</li>
				</ul>
				<div class="text-nowrap">
					<button class="btn-like" type="button">26</button>
					<button class="btn-dislike" type="button">9</button>
				</div>
				</div>
				<div class="text-center">
				<button class="btn btn-outline-accent" type="button"><i class="ci-reload me-2"></i>Load more reviews</button>
				</div>
			</div>
			<!-- Leave review form-->
			<div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
				<div class="bg-secondary py-grid-gutter px-grid-gutter rounded-3">
				<h3 class="h4 pb-2">Write a review</h3>
				<form class="needs-validation" method="post" novalidate>
					<div class="mb-3">
					<label class="form-label" for="review-name">Your name<span class="text-danger">*</span></label>
					<input class="form-control" type="text" required id="review-name">
					<div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
					</div>
					<div class="mb-3">
					<label class="form-label" for="review-email">Your email<span class="text-danger">*</span></label>
					<input class="form-control" type="email" required id="review-email">
					<div class="invalid-feedback">Please provide valid email address!</div><small class="form-text text-muted">Authentication only - we won't spam you.</small>
					</div>
					<div class="mb-3">
					<label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
					<select class="form-select" required id="review-rating">
						<option value="">Choose rating</option>
						<option value="5">5 stars</option>
						<option value="4">4 stars</option>
						<option value="3">3 stars</option>
						<option value="2">2 stars</option>
						<option value="1">1 star</option>
					</select>
					<div class="invalid-feedback">Please choose rating!</div>
					</div>
					<div class="mb-3">
					<label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
					<textarea class="form-control" rows="6" required id="review-text"></textarea>
					<div class="invalid-feedback">Please write a review!</div><small class="form-text text-muted">Your review must be at least 50 characters.</small>
					</div>
					<div class="mb-3">
					<label class="form-label" for="review-pros">Pros</label>
					<textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-pros"></textarea>
					</div>
					<div class="mb-3 mb-4">
					<label class="form-label" for="review-cons">Cons</label>
					<textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-cons"></textarea>
					</div>
					<button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
				</form>
				</div>
			</div>
			</div>
		</div>
	</div>

</div>




<!-- <nav class="bar-bottom"> 
	
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
    
</nav>  -->


@endsection