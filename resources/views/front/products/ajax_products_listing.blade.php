<!-- Product-->
<div class="row g-0 mx-n2">
    @foreach($categoryProducts as $product)
    <div class="col-xl-3 col-lg-2 col-md-4 col-sm-6 col-6 px-2 mb-3">
        <div class="card product-card card-static pb-3">

            <span class="badge bg-info badge-shadow">New</span>
            
            <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
                <i class="ci-heart"></i>
            </button>

            <a class="card-img-top d-block overflow-hidden" href="{{ url('product/'.$product['id']) }}" class="img-wrap">
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
            </a><!-- main image -->

            <div class="card-body py-2">
                <a class="product-meta d-block fs-xs pb-1" href="#">{{ $product['brand']['name'] }}</a>
                <h3 class="product-title fs-sm text-truncate">
                    <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a>
                </h3>
                <div class="product-price">         
                    @if( getDiscountedPrice($product['id']) >0)
                    <span class="text-accent"> ₹{{ getDiscountedPrice($product['id']) }}</span>
                        <small class="text-muted" style="font-size: 13px; font-weight:430;">
                        <del class="fs-sm text-muted"><small>₹{{ $product['product_price'] }}</small></del>
                        </small>
                    @else
                        <span class="text-accent">₹{{ $product['product_price'] }}</span>
                    @endif 
                </div> 
            </div>
            
        </div>
    </div>
    @endforeach
</div>
