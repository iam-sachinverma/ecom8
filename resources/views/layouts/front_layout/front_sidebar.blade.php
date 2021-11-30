<?php 
use App\Models\Section;
$sections = Section::sections();
?>

<!-- Sidebar menu-->
<aside class="offcanvas w-100 border-end" id="sideNav" style="max-width: 21.875rem;">
  <div class="pt-1 d-none d-lg-block"></div>
  <ul class="nav nav-tabs nav-justified mt-4 mb-0" role="tablist" style="min-height: 3rem;">
    <li class="nav-item">
      <a class="nav-link fw-medium active" href="#categories" data-bs-toggle="tab" role="tab">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#menu" data-bs-toggle="tab" role="tab">Menu</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fs-sm" href="#" data-bs-dismiss="offcanvas" role="tab">
        <i class="bi bi-x-lg me-2"></i>Close
      </a>
    </li>
  </ul>
  <div class="offcanvas-body px-0 pt-3 pb-0" data-simplebar>
    <div class="tab-content">
      <!-- Categories-->
      <div class="sidebar-nav tab-pane fade show active" id="categories" role="tabpanel">
        <div class="widget widget-categories">

          @foreach($sections as $section)
          @if(count($section['categories']) > 0 )
          <div class="accordion" id="shop-categories">
                    
            <!-- Category -->
            @foreach($section['categories'] as $category )
            <div class="accordion-item border-bottom">

              @if(count($category['subcategories']) > 0)
                <h3 class="accordion-header px-grid-gutter">
                  <button class="accordion-button collapsed py-3" type="button" 
                  data-bs-toggle="collapse" data-bs-target="#cat{{ $category['id'] }}" aria-expanded="false" aria-controls="drinks">
                    <span class="d-flex align-items-center">
                      {{ $category['category_name'] }}
                    </span>
                  </button>
                </h3>
                
                <div class="collapse" id="cat{{ $category['id'] }}" data-bs-parent="#shop-categories">
                  <div class="px-grid-gutter pt-1 pb-4">
                    <div class="widget widget-links">

                      <ul class="widget-list">
                      @foreach($category['subcategories'] as $subcategory)
                        <li class="widget-list-item"><a class="widget-list-link" href="#">{{ $subcategory['category_name'] }}</a></li>
                      @endforeach
                      </ul>
                      
                    </div>
                  </div>
                </div>
              @else
              <h3 class="accordion-header px-grid-gutter">
                <a class="nav-link-style d-block fs-md fw-normal py-3" href="#">
                  <span class="d-flex align-items-center">
                    {{ $category['category_name'] }}
                  </span>
                </a>
              </h3>
              @endif
    
            </div>
            @endforeach
      
          </div>
          @endif
          @endforeach

        </div>
      </div>

      <!-- Menu-->
      <div class="sidebar-nav tab-pane fade" id="menu" role="tabpanel">
        <div class="widget widget-categories">
          <div class="accordion" id="shop-menu">

            <div class="d-lg-block collapsed" id="account-menu">
              <ul class="list-unstyled mb-0">
                  <li class="border-bottom mb-0">
                      <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('/orders') }}">
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
                <!-- Account Setting / Profile -->
                <li class="border-bottom mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-profile.html">
                        <i class="ci-user opacity-60 me-2"></i>Profile info
                    </a>
                </li>
                <!-- Address Book -->
                <li class="border-bottom mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-address.html">
                        <i class="ci-location opacity-60 me-2"></i>Addresses
                    </a>
                </li>
                <!-- Sign In /  Sign Out-->
                @if(Auth::check())
                <li class="border-top mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('/logout') }}">
                        <i class="ci-sign-out opacity-60 me-2"></i>Logout
                    </a>
                </li>
                @else
                <li class="border-top mb-0">
                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('/login-register') }}">
                        <i class="ci-sign-out opacity-60 me-2"></i>Login
                    </a>
                </li>
                @endif
              </ul>
            </div>
            
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="offcanvas-footer d-block px-grid-gutter pt-4 pb-4 mb-2">
    <div class="d-flex mb-3"><i class="ci-support h4 mb-0 fw-normal text-primary mt-1 me-1"></i>
      <div class="ps-2">
        <div class="text-muted fs-sm">Support</div><a class="nav-link-style fs-md" href="tel:+100331697720">+1 (00) 33 169 7720</a>
      </div>
    </div>
    <div class="d-flex mb-3">
      <i class="ci-mail h5 mb-0 fw-normal text-primary mt-1 me-1"></i>
      <div class="ps-2">
        <div class="text-muted fs-sm">Email</div>
        <a class="nav-link-style fs-md" href="mailto:customer@pantryshop.in">customer@pantryshop.in</a>
      </div>
    </div>
      <h6 class="pt-2 pb-1">Follow us</h6>
      <a class="btn-social bs-outline bs-twitter me-2 mb-2" href="#">
        <i class="bi bi-twitter"></i>
      </a>
      <a class="btn-social bs-outline bs-facebook me-2 mb-2" href="#"> 
        <i class="bi bi-facebook"></i> 
      </a>
      <a class="btn-social bs-outline bs-instagram me-2 mb-2" href="#">
        <i class="bi bi-instagram"></i>
      </a>
      <a class="btn-social bs-outline bs-youtube me-2 mb-2" href="#">
        <i class="bi bi-youtube"></i>
      </a>
  </div>
</aside>