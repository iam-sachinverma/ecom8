@extends('layouts.front_layout.front_layout')
@section('content')

<!-- <main class="app-content">

    <section class="p-3 bg-primary">

        <div class="mb-4 d-flex">

            <a href="{{ url()->previous() }}" class="btn-header">
                <i class="material-icons md-arrow_back text-white col"></i>
            </a>

            <a href="" class="ms-4"><h1 class="fs-4 fw-normal text-white">My Account</h1></a>
           
        </div>

        <a href="28.page-settings.html" class="float-end"><i class="material-icons md-edit text-white"></i></a>
        <figure class="icontext align-items-center mr-4" style="max-width: 300px;">
            <figcaption class="text text-white">
                <p class="h5 title mb-1">{{ Auth::user()->name }}</p>
                <p class="text-white-50 lh-sm">+91 {{ Auth::user()->mobile }}<br> {{ Auth::user()->email }}</p>
            </figcaption>
        </figure>
    </section>
    
    <section class="p-3">
        <ul class="row">
            <li class="col-4">
                <a href="{{ url('account/orders') }}" class="item-category-grid">
                    <span class="icon-wrap"> <i class="icon material-icons md-shopping_basket"></i>  </span>
                    <small class="text"> Orders </small>
                </a>
            </li>
            <li class="col-4">
                <a href="27.page-profile.html#" class="item-category-grid">
                    <span class="icon-wrap"> <i class="icon material-icons md-favorite"></i>  </span>
                    <small class="text"> Wishlist</small>
                </a>
            </li>
            <li class="col-4">
                <a href="27.page-profile.html#" class="item-category-grid">
                    <span class="icon-wrap"> <i class="icon material-icons md-account_balance_wallet"></i>  </span>
                    <small class="text"> Payment </small>
                </a>
            </li>
        </ul>
    </section>  
    
    <hr class="divider">

    <section>
        <h5 class="title-section pb-2">Orders</h5>
        <nav class="nav-list">
            <a class="btn-list" href="27.page-profile.html#">
                <span class="float-end badge bg-warning">3</span>
                <span class="text">On proccess</span>
            </a>
            <a class="btn-list" href="27.page-profile.html#">
                <span class="float-end badge bg-success">1</span>
                <span class="text">Shipped</span>
            </a>
            <a class="btn-list" href="27.page-profile.html#"> 
                <span class="float-end badge bg-secondary">0</span>
                <small class="title"></small>
                <span class="text">Unpaid</span>
            </a>
        </nav>
    </section> 

    <hr class="divider"> 

    <section>
        <nav class="nav-list fs-5">
            <a class="btn-list" href="{{ url('account/edit-profile') }}">
                <i class="bi bi-person-circle"></i>&nbsp;&nbsp;
                <i class="icon-control material-icons md-keyboard_arrow_right"></i>
                <span class="text">Account Settings</span>
            </a>
            <a class="btn-list" href="{{ url('account/address-book') }}"> 
                <i class="bi bi-geo-alt"></i>&nbsp;&nbsp;
                <i class="icon-control material-icons md-keyboard_arrow_right"></i>
                <span class="text">My Delivery Address</span>
            </a>
            <a class="btn-list" href="{{ url('logout') }}"> 
                <i class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;
                <span class="text">Logout</span>
            </a>
        </nav>
    </section> 
    
    <hr class="divider"> 
    
</main> -->


<!-- Page Title-->
<div class="page-title-overlap bg-body pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
         <h1 class="h3 text-light mb-0">My Account</h1>
        </div>
    </div>
</div>
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
    
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
            <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
                <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                    <div class="d-md-flex align-items-center">
                        <div class="ps-md-3">
                         <h3 class="fs-base mb-0">{{ Auth::user()->name }}</h3>
                         <span class="text-accent fs-sm">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-lg-block collapsed" id="account-menu">
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="fs-sm mb-0 text-muted">Dashboard</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('account/orders') }}">
                                <i class="ci-bag opacity-60 me-2"></i>Orders<span class="fs-sm text-muted ms-auto">1</span>
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('/wishlist') }}">
                                <i class="ci-heart opacity-60 me-2"></i>Wishlist<span class="fs-sm text-muted ms-auto">3</span>
                            </a>
                        </li>
                    </ul>
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="account-profile.html">
                                <i class="ci-user opacity-60 me-2"></i>Profile info
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-address.html">
                                <i class="ci-location opacity-60 me-2"></i>Addresses
                            </a>
                        </li>
                        <li class="mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html">
                                <i class="ci-card opacity-60 me-2"></i>Payment methods
                            </a>
                        </li>
                        <li class="d-lg-none border-top mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html">
                                <i class="ci-sign-out opacity-60 me-2"></i>Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
    
        <!-- Content  -->
        <section class="col-lg-8">
    
        <!-- Toolbar-->
        <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
            <a class="btn btn-primary btn-sm" href="{{ url('/logout') }}">
                <i class="ci-sign-out me-2"></i>Sign out
            </a>
        </div>
        
        </section>
    </div>
</div>
    
@endsection