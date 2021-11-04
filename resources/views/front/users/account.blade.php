@extends('layouts.front_layout.front_layout')
@section('content')

<main class="app-content">

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
    
</main> <!-- app-content.// -->
    
    
   

@endsection