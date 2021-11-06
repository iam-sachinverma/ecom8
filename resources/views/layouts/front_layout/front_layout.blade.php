<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">

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

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name=”theme-color” content=”#0d6efd>
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('images/front_images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

<!-- Bootstrap -->
<link href="{{ url('css/front_css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>

<!-- custom style -->
<link href="{{ url('css/front_css/ui.css') }}" rel="stylesheet" type="text/css"/>

<!-- Fonticon -->
<link href="{{ url('fonts/front/material-icon/css/round.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- Jquery Validate Style  -->
<style>
    form.cmxform label.error, label.error{
		color: rgb(236, 93, 93);
		font-size: 13px;
	}
</style>

</head>
<body>

<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow" role="status">
	  <span class="visually-hidden">Loading...</span>
	</div>
</div>
<!-- Preloader //end -->

@include('layouts.front_layout.front_header')

@yield('content')

@include('layouts.front_layout.front_sidebar')

@include('layouts.front_layout.front_footer')

<!-- jQuery -->
<script src="{{ url('js/front_js/jquery.js') }}" type="text/javascript"></script>
{{-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> --}}
<script src="{{ url('js/front_js/jquery.validate.js') }}" type="text/javascript"></script>

<!-- Bootstrap 5 JS -->
{{-- <script src="{{ url('js/front_js/bootstrap.bundle.js') }}" type="text/javascript"></script>  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- custom javascript -->
<script src="{{ url('js/front_js/front_script.js') }}" type="text/javascript"></script>
<script src="{{ url('js/front_js/script.js') }}" type="text/javascript"></script>

<!-- plugin: fancybox  -->
<link href="{{ url('plugins/front/fancybox/fancybox.min.css') }}" type="text/css" rel="stylesheet">
<script src="{{ url('plugins/front/fancybox/fancybox.min.js') }}" type="text/javascript"></script>

<!-- PWA -->
<script src="{{ url('js/front_js/pwa.js') }}"></script>

</body>
</html>