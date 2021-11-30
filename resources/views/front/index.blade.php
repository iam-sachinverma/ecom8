@extends('layouts.front_layout.front_layout')
@section('content')

<!-- Home page banner  -->
@if(isset($page_name) && $page_name=="index")
    @include('front.banners.home_page_banners')
@endif

<!-- Product Slider (Lastest)-->
<section class="container pt-lg-3 mb-4 mb-sm-5">
    <div class="row">
        <!-- Banner with controls-->
        <div class="col-md-5">
            <div class="d-flex flex-column h-100 overflow-hidden rounded-3" style="background-color: #f6f8fb;">
                <div class="d-flex justify-content-between px-grid-gutter py-grid-gutter">
                <div>
                    <h3 class="mb-1">For Women</h3><a class="fs-md" href="shop-grid-ls.html">Shop for women<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
                </div>
                <div class="tns-carousel-controls" id="for-women">
                    <button type="button"><i class="ci-arrow-left"></i></button>
                    <button type="button"><i class="ci-arrow-right"></i></button>
                </div>
                </div><a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100" src="img/home/categories/cat-lg02.jpg" alt="For Women"></a>
            </div>
        </div>
        <!-- Product grid (carousel)-->
        <div class="col-md-7 pt-4 pt-md-0">
            <div class="tns-carousel">
                <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-women&quot;}">
                   
                    <!-- Carousel item-->
                    <div>
                        <div class="row mx-n2">
                            @foreach($featuredItems as $item)
                            <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                                <div class="card product-card card-static">
                                
                                <a class="card-img-top d-block overflow-hidden" href="{{ url('product/'.$item['id']) }}">
                                    @if(isset($item['main_image']))
                                    <?php $product_image_path = 'images/product_images/medium/'.$item['main_image']; ?>
                                    @else
                                    <?php $product_image_path = ''; ?>
                                    @endif
                                    @if(!empty($item['main_image']) && file_exists($product_image_path))
                                    <img src="{{ asset($product_image_path) }}" alt="{{ $item['product_name'] }}">
                                    @else
                                    <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="{{ $item['product_name'] }}">
                                    @endif 
                                </a>

                                <div class="card-body py-2">
                                    <a class="product-meta d-block fs-xs pb-1" href="#">{{ $item['brand']['name'] }}</a>
                                    <h3 class="product-title fs-sm">
                                        <a href="{{ url('product/'.$item['id']) }}">{{ $item['product_name'] }}</a>
                                    </h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price">
                                         <span class="text-accent">$12.<small>99</small></span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Slider (Featured Products)-->
<section class="container pt-lg-4 mb-4 mb-sm-5">
    <div class="row">
        <!-- Banner with controls-->
        <div class="col-md-5 order-md-2">
        <div class="d-flex flex-column h-100 overflow-hidden rounded-3" style="background-color: #f6f8fb;">
            <div class="d-flex justify-content-between px-grid-gutter py-grid-gutter">
            <div class="order-md-2">
                <h3 class="mb-1">For Men</h3><a class="fs-md" href="shop-grid-ls.html">Shop for men<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a>
            </div>
            <div class="tns-carousel-controls order-md-1" id="for-men">
                <button type="button"><i class="ci-arrow-left"></i></button>
                <button type="button"><i class="ci-arrow-right"></i></button>
            </div>
            </div><a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100" src="img/home/categories/cat-lg01.jpg" alt="For Men"></a>
        </div>
        </div>
        <!-- Product grid (carousel)-->
        <div class="col-md-7 pt-4 pt-md-0 order-md-1">
        <div class="tns-carousel">
            <div class="tns-carousel-inner" data-carousel-options="{&quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#for-men&quot;}">
            <!-- Carousel item-->
            <div>
                <div class="row mx-n2">
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/32.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Hats &amp; Caps</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Cap with Appliqué</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$15.<small>99</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/33.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">T-shirts</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Regular Fit Cotton Shirt</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$19.<small>99</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/34.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Accessories</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Polarized Sunglasses</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$37.<small>99</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/35.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Shoes</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Leather Men’s Sneakers</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$45.<small>99</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4 d-none d-lg-block">
                    <div class="card product-card card-static"><span class="badge badge-info badge-shadow">Popular</span>
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/36.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Bags</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Swedish Backpack</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$68.<small>95</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4 d-none d-lg-block">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/37.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Accessories</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Stainless Steel Watches</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$542.<small>80</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Carousel item-->
            <div>
                <div class="row mx-n2">
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/11.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Sandals</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Soft Footbed Sandals</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$99.<small>50</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/38.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Shorts</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Silver Ringe Cargo Short</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$45.<small>00</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/10.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Shorts</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">Multicolor Bracelets</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$7.<small>99</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/39.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">T-shirts</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">3-pack T-shirts Slim Fit</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$21.<small>70</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4 d-none d-lg-block">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/12.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Hats &amp; Caps</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$25.<small>9</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6 px-0 px-sm-2 mb-sm-4 d-none d-lg-block">
                    <div class="card product-card card-static">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img src="img/shop/catalog/06.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Bags</a>
                        <h3 class="product-title fs-sm"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h3>
                        <div class="d-flex justify-content-between">
                        <div class="product-price"><span class="text-accent">$79.<small>50</small></span></div>
                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>


@endsection