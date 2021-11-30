<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">

<!-- Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(!empty($meta_title))
    <title>{{  $meta_title }}</title>
@else
    <title>Best Online Gourment Food Store in India. Save Big on Gourment Food Shopping | pantryshop.in</title>
@endif

@if(!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">
@else
    <meta name="description" content="All types of gourment food like pasta, soup , noodles">
@endif    

@if(!empty($meta_description))
    <meta name="keywords" content="{{ $meta_keywords }}">
@else
    <meta name="keywords" content="gourment food, pasta, soup, ecommerce, shop online, "> 
@endif

<!-- Vendor Styles including: Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{ url('plugins/front/simplebar/dist/simplebar.min.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ url('plugins/front/tiny-slider/dist/tiny-slider.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ url('plugins/front/drift-zoom/dist/drift-basic.min.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ url('plugins/front/lightgallery.js/dist/css/lightgallery.min.css') }}"/>
<!-- Main Theme Styles + Bootstrap-->
<link rel="stylesheet" media="screen" href="{{ url('css/front_css/theme.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

<!-- Jquery Validate Style  -->
<style>
    form.cmxform label.error, label.error{
		color: rgb(236, 93, 93);
		font-size: 13px;
	}
</style>

</head>
<body class="handheld-toolbar-enabled">

  
  <main class="page-wrapper">

    @include('layouts.front_layout.front_header')

    @yield('content')

    @include('layouts.front_layout.front_sidebar')

  </main>

    @include('layouts.front_layout.front_footer')

    <!-- Toolbar for handheld devices (Default)-->
    <div class="handheld-toolbar">
        <div class="d-table table-layout-fixed w-100">
            
            @if(isset($page_name) && $page_name=="listing")
            <a class="d-table-cell handheld-toolbar-item" data-bs-toggle="offcanvas" data-bs-target="#shop-sidebar">
              <span class="handheld-toolbar-icon"><i class="bi bi-sliders"></i></span>
              <span class="handheld-toolbar-label">Filters</span>
            </a>
            @endif 

            <a class="d-table-cell handheld-toolbar-item" href="{{ url('/wishlist') }}">
              <span class="handheld-toolbar-icon"><i class="bi bi-heart"></i></span>
              <span class="handheld-toolbar-label">Wishlist</span>
            </a>

            <a class="d-table-cell handheld-toolbar-item" href="{{ url('/orders') }}">
              <span class="handheld-toolbar-icon"><i class="bi bi-grid-3x2-gap"></i></span>
              <span class="handheld-toolbar-label">Categories</span>
            </a>
            
            <a class="d-table-cell handheld-toolbar-item" href="{{ url('/cart') }}">
                <span class="handheld-toolbar-icon">
                 <i class="bi bi-cart2"></i>
                 <span class="badge bg-primary rounded-pill ms-1">{{ totalCartItems() }}</span>
                </span>
                <span class="handheld-toolbar-label">$265.00</span>
            </a>
        </div>
    </div>

    <!-- Back To Top Button-->
    <a class="btn-scroll-top" href="#top" data-scroll data-fixed-element>
        <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
        <i class="btn-scroll-top-icon ci-arrow-up">   </i>
    </a>

 <!-- Main theme script-->
 <script src="{{ url('js/front_js/jquery.js') }}"></script>
 <script src="{{ url('js/front_js/jquery.validate.js') }}"></script>
 
 <!-- Vendor scrits: js libraries and plugins-->
 <script src="{{ url('plugins/front/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ url('plugins/front/simplebar/dist/simplebar.min.js') }}"></script>
 <script src="{{ url('plugins/front/tiny-slider/dist/min/tiny-slider.js') }}"></script>
 <script src="{{ url('plugins/front/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
 <script src="{{ url('plugins/front/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
 <script src="{{ url('plugins/front/drift-zoom/dist/Drift.min.js') }}"></script>
 <script src="{{ url('plugins/front/lightgallery.js/dist/js/lightgallery.min.js') }}"></script>
 <script src="{{ url('plugins/front/lg-video.js/dist/lg-video.min.js') }}"></script>

 <!-- Vendor Fancy Box -->
 <link rel="stylesheet" href="{{ url('plugins/front/fancybox/fancybox.min.css') }}">
 <script src="{{ url('plugins/front/fancybox/fancybox.min.js') }}" type="text/javascript"></script>
 
 <!-- Main theme script-->
 <script src="{{ url('js/front_js/front_script.js') }}"></script>
 <script src="{{ url('js/front_js/theme.min.js') }}"></script>

</body>
</html>