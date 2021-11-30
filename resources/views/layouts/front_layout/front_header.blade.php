<!-- Sign in / sign up modal-->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Sign in</a></li>
          <li class="nav-item"><a class="nav-link fw-medium" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false"><i class="ci-user me-2 mt-n1"></i>Sign up</a></li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content py-4">
        <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
          <div class="mb-3">
            <label class="form-label" for="si-email">Email address</label>
            <input class="form-control" type="email" id="si-email" placeholder="johndoe@example.com" required>
            <div class="invalid-feedback">Please provide a valid email address.</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="si-password">Password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="si-password" required>
              <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <div class="mb-3 d-flex flex-wrap justify-content-between">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="si-remember">
              <label class="form-check-label" for="si-remember">Remember me</label>
            </div><a class="fs-sm" href="#">Forgot password?</a>
          </div>
          <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign in</button>
        </form>
        <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab">
          <div class="mb-3">
            <label class="form-label" for="su-name">Full name</label>
            <input class="form-control" type="text" id="su-name" placeholder="John Doe" required>
            <div class="invalid-feedback">Please fill in your name.</div>
          </div>
          <div class="mb-3">
            <label for="su-email">Email address</label>
            <input class="form-control" type="email" id="su-email" placeholder="johndoe@example.com" required>
            <div class="invalid-feedback">Please provide a valid email address.</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="su-password">Password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="su-password" required>
              <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="su-password-confirm">Confirm password</label>
            <div class="password-toggle">
              <input class="form-control" type="password" id="su-password-confirm" required>
              <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign up</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Navbar 3 Level (Light)-->
<header class="shadow-sm">
  <!-- Topbar-->
  <div class="topbar topbar-dark bg-dark d-none d-md-block">
    <div class="container">
      <div class="topbar-text dropdown d-md-none">
        <a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Useful links</a>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="tel:8700807259"><i class="bi bi-telephone-outbound"></i>8700807259</a>
          </li>
          <li>
            <a class="dropdown-item" href="order-tracking.html"><i class="bi bi-geo-alt text-muted me-2"></i>Order tracking
            </a>
          </li>
        </ul>
      </div>
      <div class="topbar-text text-nowrap d-none d-md-inline-block">
        <i class="bi bi-telephone-outbound"></i>
        <span class="text-muted me-1">Support</span>
        <a class="topbar-link" href="tel:8700807259">8700807259</a>
      </div>

      <div class="tns-carousel tns-controls-static d-none d-md-block">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false}">
          <div class="topbar-text">Free shipping for order over &#x20B9;1000</div>
          <div class="topbar-text">We return money within 30 days</div>
          <div class="topbar-text">Friendly 24/7 customer support</div>
        </div>
      </div>

      <div class="ms-3 text-nowrap">
        <a class="topbar-link me-4 d-none d-md-inline-block" href="order-tracking.html">
          <i class="bi bi-geo-alt"></i>Order tracking
        </a>
      </div>
    </div>
  </div>
  <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
  <div class="navbar-sticky bg-light">
    <div class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">

        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav">
          <span class="navbar-toggler-icon"></span>
        </button> -->

        <button class="navbar-nav btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand d-none d-sm-block flex-shrink-0" href="{{ url('/') }}">
          <!-- <img src="img/logo-dark.png" width="142" alt="PantryShop"> -->
          <span>PantryShop</span>
        </a>
        <a class="navbar-brand d-sm-none flex-shrink-0 me-2" href="{{ url('/') }}">
          <!-- <img src="img/logo-icon.png" width="74" alt="PantryShop"> -->
          <span>PantryShop</span>

        </a>

        <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center order-lg-3">
         
          @if(Auth::check())
          
          <a class="navbar-tool d-none d-lg-flex" href="{{ url('/wishlist') }}">
            <span class="navbar-tool-tooltip">Wishlist</span>
            <div class="navbar-tool-icon-box">
              <i class="navbar-tool-icon bi bi-heart"></i>
            </div>
          </a>

          <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ url('/account') }}">
            <div class="navbar-tool-icon-box">
              <i class="navbar-tool-icon bi bi-person-circle"></i>
            </div>
            <div class="navbar-tool-text ms-n3">
              <small>Hello, {{ Auth::user()->name }}</small>My Account
            </div>
          </a>

          @else

          <a class="navbar-tool d-none d-lg-flex" href="{{ url('/login-register') }}">
            <span class="navbar-tool-tooltip">Wishlist</span>
            <div class="navbar-tool-icon-box">
              <i class="navbar-tool-icon bi bi-heart"></i>
            </div>
          </a>

          <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ url('/login-register') }}">
            <div class="navbar-tool-icon-box">
              <i class="navbar-tool-icon bi bi-person-circle"></i>
            </div>
            <div class="navbar-tool-text ms-n3">
              <small>Hello, Sign in</small>My Account
            </div>
          </a>

          @endif

          <div class="navbar-tool dropdown ms-3  d-none d-lg-flex">  
            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ url('/cart') }}">
              <span class="navbar-tool-label">{{ totalCartItems() }}</span>
              <i class="navbar-tool-icon bi bi-cart2"></i>
            </a>
            <a class="navbar-tool-text" href="{{ url('/cart') }}">
              <small>My Cart</small>$265.00
            </a>
            
            <!-- Cart dropdown-->
            <div class="dropdown-menu dropdown-menu-end">
              <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                  <div class="widget-cart-item pb-2 border-bottom">
                    <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/01.jpg" width="64" alt="Product"></a>
                      <div class="ps-2">
                        <h6 class="widget-product-title"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h6>
                        <div class="widget-product-meta"><span class="text-accent me-2">$150.<small>00</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-cart-item py-2 border-bottom">
                    <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/02.jpg" width="64" alt="Product"></a>
                      <div class="ps-2">
                        <h6 class="widget-product-title"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h6>
                        <div class="widget-product-meta"><span class="text-accent me-2">$79.<small>50</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-cart-item py-2 border-bottom">
                    <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/03.jpg" width="64" alt="Product"></a>
                      <div class="ps-2">
                        <h6 class="widget-product-title"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h6>
                        <div class="widget-product-meta"><span class="text-accent me-2">$22.<small>50</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-cart-item py-2 border-bottom">
                    <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="d-flex align-items-center"><a class="flex-shrink-0" href="shop-single-v1.html"><img src="img/shop/cart/widget/04.jpg" width="64" alt="Product"></a>
                      <div class="ps-2">
                        <h6 class="widget-product-title"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h6>
                        <div class="widget-product-meta"><span class="text-accent me-2">$9.<small>00</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                  <div class="fs-sm me-2 py-2"><span class="text-muted">Subtotal:</span><span class="text-accent fs-base ms-1">$265.<small>00</small></span></div><a class="btn btn-outline-secondary btn-sm" href="shop-cart.html">Expand cart<i class="ci-arrow-right ms-1 me-n1"></i></a>
                </div><a class="btn btn-primary btn-sm d-block w-100" href="checkout-details.html"><i class="ci-card me-2 fs-base align-middle"></i>Checkout</a>
              </div>
            </div>
          </div>

        </div>

     
          <div class="input-group input-group-sm d-lg-flex mx-lg-4">
            <input class="form-control rounded-end pe-5" type="text" name="search" placeholder="Search for products">
            <!-- <button class="btn" type="submit" id="search-button"> -->
             <i class="btn bi bi-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3" type="submit" id="search-button"></i>
            <!-- </button> -->
          </div>
       

            <!-- <form action="{{ url('/search-products') }}" method="get">
         <div class="input-group input-group-sm mb-2">
          <input type="text" name="search" class="form-control" placeholder="search product" aria-label="search product" aria-describedby="search-button">
          <button class="btn btn-outline-secondary" type="submit" id="search-button"><i class="bi bi-search"></i></button>
         </div>
        </form>         -->
          
        

        
        
      </div>
    </div>
    
  </div>
</header>

	
