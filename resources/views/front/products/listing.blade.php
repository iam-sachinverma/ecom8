@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm">
	
	<a href="javascript:history.go(-1)" class="btn-header">
		<i class="material-icons md-arrow_back"></i>
	</a>
	
	<h5 class="title-header">  {{ $categoryDetails['catDetails']['category_name'] }}  </h5>
	
	<a href="09.page-listing-e.html#" class="btn-header"> 
		<i class="material-icons md-search"></i> 
 	</a> 

</header> <!-- app-header.// -->

<main class="app-content">

@if(!isset($_REQUEST['search']))
<section class="px-3 pt-1 pb-2 bg-light text-dark">
	<div class="row mt-2">
		<div class="col-8">
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
		</div>

		<div class="col-4">
			<button type="button" data-bs-target="#offcanvas_filter" data-bs-toggle="offcanvas" class="btn w-100 btn-sm text-start border-0" style="background-color: white"> 
				Show filter
			</button>
		</div>
	</div>
</section>
@endif

<section id="filter_products" class="filter_products">
	@include('front.products.ajax_products_listing') 
</section>

@if(!isset($_REQUEST['search']))
<div class="pagination d-flex justify-content-center">
	@if(isset($_GET['sort']) && !empty($_GET['sort'] ))
	 {{ $categoryProducts->appends(['sort' => $_GET['sort'] ]); }}
	@else
	 {{ $categoryProducts->links() }}
    @endif
</div>
@endif


</main> <!-- app-content.// -->

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
</aside> <!-- offcanvas.// -->


@endsection