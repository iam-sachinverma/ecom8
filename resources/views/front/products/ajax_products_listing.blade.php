<div id="product" class="p-2">
    <ul class="row">
        @foreach($categoryProducts as $product)
            <li class="col-12 col-sm-12 col-md-6 my-2">
                <article class="product-list">
                    <a href="{{ url('product/'.$product['id']) }}" class="img-wrap">
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
                    </a><!-- main image -->
                    
                    <div class="info-wrap">
                        
                       
                        <a href="09.page-listing-e.html#" class="float-end">  
                            <i class="material-icons md-favorite_border"></i> 
                        </a>

                        <p class="title" style="font-size: 13px;">{{ $product['brand']['name'] }} {{ $product['id'] }}</p>
                        <a href="{{ url('product/'.$product['id']) }}"><h1 class="title fs-6 fw-normal">{{ $product['product_name'] }}</h1></a>

                        <div class="rating-wrap mb-2">
                            <ul class="rating-stars">
                                <li style="width:100%;" class="stars-active">
                                        <img src="images/front_images/misc/stars-active.svg" height="16" alt="stars">
                                </li>
                                <li>
                                        <img src="images/front_images/misc/stars-disable.svg" height="16" alt="stars">
                                </li>
                            </ul>
                            <small class="label-rating text-muted">9/10</small>
                        </div> <!-- rating-wrap end// -->

     
                        <div class="price mt-2">
                            @if( getDiscountedPrice($product['id'] ) > 0)
                             ₹{{ getDiscountedPrice($product['id'] ) }}&nbsp;&nbsp;<small class="text-muted"><del>₹{{ $product['product_price'] }}</del></small>
                            @else
                             ₹{{ $product['product_price'] }}
                            @endif 
                        </div>
                        
                        <a href="09.page-listing-e.html#" class="float-end">  
                            <button type="button" class="btn btn-success btn-sm">Add Cart</button>
                        </a>

                    </div> 
                </article> <!-- product-list end// -->
            </li> <!-- col.// -->
        @endforeach
    </ul> <!-- row.// -->
</div>