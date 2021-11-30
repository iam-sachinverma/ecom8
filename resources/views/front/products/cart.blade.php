@extends('layouts.front_layout.front_layout')
@section('content')

<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
    <div class="container-fluid d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
            <li class="breadcrumb-item text-nowrap"><a href="shop-grid-ls.html">Shop</a>
            </li>
            <li class="breadcrumb-item text-nowrap active" aria-current="page">Cart</li>
            </ol>
        </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 text-light mb-0">Your cart</h1>
        </div>
    </div>
</div>

    @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
            <strong>{{ Session::get('error_message')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php Session::forget('error_message'); ?>
    @endif

<div class="container-fluid AppendCartItems pb-5 mb-2 mb-md-4">
    @include('front.products.cart_items')
</div>

@endsection