@extends('layouts.front_layout.front_layout')
@section('content')

<aside class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_filter">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Filter by</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <article class="offcanvas-body">

    @if(isset($page_name) && $page_name == "listing" && !isset($_REQUEST['search']) )


        <h5 class="mb-3">Brand</h5>
        @foreach($brandArray as $brand)
            <label class="form-check mb-2">
                <input class="brand form-check-input" type="checkbox" name="brand[]" id="{{ $brand }}" value="{{ $brand }}" method="post">
                <div class="form-check-label">{{ $brand }}</div>
            </label>
        @endforeach
        
        <hr>

        <h5 class="mb-3">Cuisine</h5>
        @foreach($cuisineArray as $cuisine)
            <label class="form-check mb-2">
                <input class="cuisine form-check-input" type="checkbox" name="cuisine[]" id="{{ $cuisine }}" value="{{ $cuisine }}" method="post">
                <div class="form-check-label">{{ $cuisine }}</div>
            </label>
        @endforeach
        
        <hr>

        <h5 class="mb-3">Country</h5>
        @foreach($countryArray as $country)
            <label class="form-check mb-2">
                <input class="country form-check-input" type="checkbox" name="country[]" id="{{ $country }}" value="{{ $country }}">
                <div class="form-check-label">{{ $country }}</div>
            </label>
        @endforeach

        <hr>

        <h5 class="mb-3">Food Preference</h5>
        @foreach($foodpreferenceArray as $foodpreference)
            <label class="form-check mb-2">
                <input class="foodpreference form-check-input" type="checkbox" name="foodpreference[]" id="{{ $foodpreference }}" value="{{ $foodpreference }}">
                <div class="form-check-label">{{ $foodpreference }}</div>
            </label>
        @endforeach

        <hr>

        <button type="button" class="btn btn-light w-100" data-bs-dismiss="offcanvas">Apply filter</button>

    @endif

  </article> <!-- offcanvas-body .// -->
</aside> 


<!-- Page Title (Light)-->
<div class="bg-secondary py-4">
    <div class="container-fluid d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item">
                <a class="text-nowrap" href="{{ url('/') }}">
                <i class="bi bi-house"></i>Home</a>
            </li>
            <li class="breadcrumb-item text-nowrap active" aria-current="page">
                <?php echo $categoryDetails['breadcrumbs']; ?>
            </li>
            </ol>
        </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 mb-0">{{ $categoryDetails['catDetails']['category_name'] }} </h1>
        </div>
    </div>
</div>



<div class="container-fluid pb-5 mb-2 mb-md-4 bg-secondary">
    <div class="row">

        <!-- Sidebar-->
        <aside class="col-lg-4">
            <!-- Sidebar-->
            <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
                <div class="offcanvas-header align-items-center shadow-sm">
                 <h2 class="h5 mb-0">Filters</h2>
                 <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
                    <!-- Categories-->
                    <div class="widget widget-categories mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Categories</h3>
                        <div class="accordion mt-n1" id="shop-categories">
                            <!-- Shoes-->
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <a class="accordion-button collapsed" href="#shoes" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="shoes">Shoes</a>
                                </h3>
                                <div class="accordion-collapse collapse" id="shoes" data-bs-parent="#shop-categories">
                                <div class="accordion-body">
                                    <div class="widget widget-links widget-filter">
                                  
                                    <ul class="widget-list widget-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Ankle Boots</span><span class="fs-xs text-muted ms-3">50</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Loafers</span><span class="fs-xs text-muted ms-3">93</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Slip-on</span><span class="fs-xs text-muted ms-3">122</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Flip Flops</span><span class="fs-xs text-muted ms-3">116</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Clogs &amp; Mules</span><span class="fs-xs text-muted ms-3">24</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Athletic Shoes</span><span class="fs-xs text-muted ms-3">31</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Oxfords</span><span class="fs-xs text-muted ms-3">9</span></a></li>
                                        <li class="widget-list-item widget-filter-item"><a class="widget-list-link d-flex justify-content-between align-items-center" href="#"><span class="widget-filter-item-text">Smart Shoes</span><span class="fs-xs text-muted ms-3">18</span></a></li>
                                    </ul>

                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter by Brand-->
                    <div class="widget widget-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Brand</h3>
                        <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                            @foreach($brandArray as $brand)               
                            <li class="widget-filter-item d-flex justify-content-between align-items-center">  
                                <div class="form-check">
                                 <input class="brand form-check-input" type="checkbox" name="brand[]" id="{{ $brand }}" value="{{ $brand }}" method="post">
                                 <label class="form-check-label widget-filter-item-text" for="wrangler">{{ $brand }}</label>
                                </div>
                                <!-- <span class="fs-xs text-muted">115</span> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Filter by Ciusine-->
                    <div class="widget widget-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Cuisine</h3>
                        <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                            @foreach($cuisineArray as $cuisine)               
                            <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="form-check">
                                    <input class="cuisine form-check-input" type="checkbox" name="cuisine[]" id="{{ $cuisine }}" value="{{ $cuisine }}" method="post">
                                    <label class="form-check-label widget-filter-item-text" for="cuisine">{{ $cuisine }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Filter by Country-->
                    <div class="widget widget-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Country</h3>
                        <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                            @foreach($countryArray as $country)               
                            <li class="widget-filter-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                 <input class="country form-check-input" type="checkbox" name="country[]" id="{{ $country }}" value="{{ $country }}" method="post">
                                 <label class="form-check-label widget-filter-item-text" for="country">{{ $country }}</label>
                                </div>
                                <!-- <span class="fs-xs text-muted">115</span> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Filter by Foodpreference-->
                    <div class="widget widget-filter mb-4 pb-4 border-bottom">
                        <h3 class="widget-title">Foodpreference</h3>
                        <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                            @foreach($foodpreferenceArray as $foodpreference)               
                            <li class="widget-filter-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                 <input class="foodpreference form-check-input" type="checkbox" name="foodpreference[]" id="{{ $foodpreference }}" value="{{ $foodpreference }}" method="post">
                                 <label class="form-check-label widget-filter-item-text" for="foodpreference">{{ $foodpreference }}</label>
                                </div>
                                <!-- <span class="fs-xs text-muted">115</span> -->
                            </li>
                            @endforeach
                        </ul>
                    </div>
                 

                </div>
            </div>
        </aside>
        
        <!-- Content  -->
        <section class="col-lg-8">
         
            <!-- Toolbar-->
            @if(!isset($_REQUEST['search']))
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                    <div class="d-flex flex-wrap">
                        <div class="d-flex align-items-center flex-nowrap me-3 me-sm-4 pb-3">
                            <label class="text-dark opacity-75 text-nowrap fs-sm me-2 d-none d-sm-block" for="sorting">Sort by:</label>
                            <form name="sortProducts" id="sortProducts">
                                <input type="hidden" name="url" id="url" value="{{ $url }}">
                            
                                <select name="sort" id="sort" class="form-select form-select-sm btn-white text-dark border-0">
                                    <option value="">Sort by</option>
                                    <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected="" @endif>Lastest Product</option>
                                    <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected="" @endif>Price - Low to High</option>
                                    <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>Price - High to Low</option>
                                    <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_a_z") selected="" @endif>Product Name - A to z</option>
                                    <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_z_a") selected="" @endif>Product Name - Z to A</option>
                                </select>
                                
                            </form>
                            <span class="fs-sm text-dark opacity-75 text-nowrap ms-2 d-none d-md-block">of 287 products</span>
                        </div>
                    </div>
                    
                    <div class="d-lg-none d-sm-flex pb-3">
                    <a class="btn btn-sm btn-outline-accent" data-bs-toggle="offcanvas" data-bs-target="#shop-sidebar">Filter <i class="bi bi-sliders ms-1 me-n1"></i>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Products list-->
            <!-- Products grid-->
            <div class="filter_products" id="filter_products">
                @include('front.products.ajax_products_listing')  
            </div>

            <div class="border-top pt-3 mt-3"></div>
      
            <!-- Banner-->
            <div class="d-sm-flex justify-content-between align-items-center bg-secondary overflow-hidden my-4 rounded-3">
                <div class="py-4 my-2 my-md-0 py-md-5 px-4 ms-md-3 text-center text-sm-start">
                <h4 class="fs-lg fw-light mb-2">Converse All Star</h4>
                <h3 class="mb-4">Make Your Day Comfortable</h3><a class="btn btn-primary btn-shadow btn-sm" href="#">Shop Now</a>
                </div><img class="d-block ms-auto" src="img/shop/catalog/banner.jpg" alt="Shop Converse">
            </div>
  
            <div class="border-top pt-3 mt-3"></div>

            <!-- Pagination-->
            <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Prev</a></li>
                </ul>
                <ul class="pagination">
                <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                </ul>
                <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
                </ul>
            </nav>

        </section>
    </div>
</div>

<!-- @if(!isset($_REQUEST['search']))
    <div class="pagination d-flex justify-content-center">
        @if(isset($_GET['sort']) && !empty($_GET['sort'] ))
        {{ $categoryProducts->appends(['sort' => $_GET['sort'] ]); }}
        @else
        {{ $categoryProducts->links() }}
        @endif
    </div>
    @endif -->



@endsection