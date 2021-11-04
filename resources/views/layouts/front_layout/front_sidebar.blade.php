 <aside class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas_left_123">
    <header class="p-3 border-bottom bg-light">
      <button type="button" class="float-end btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      
      @if(Auth::check())
        <a href="{{ url('/account') }}" class="icontext">
            <img src="images//front_images/avatars/1.jpg" class="icon avatar-sm" alt="">
            <div class="text">
                <h6 class="mb-0">Hi {{ Auth::user()->name }}</h6>
                <small>My profile</small>
            </div>
        </a>  
      @else
        <a href="{{ url('/login-register') }}" class="icontext">
          <div class="text">
              <h6 class="mb-0">Login / Register</h6>
          </div>
        </a>
      @endif  

    </header>
    <article class="offcanvas-body">
      <nav class="nav-sidebar mt-2">
            <a href="index.html"> <i class="material-icons md-apps"></i> All pages </a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-local_offer"></i> New offers</a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-store"></i> Wholsesalers </a>
            @if(Auth::check())
            <hr>
            <a href="02.page-index-b.html#"> <i class="material-icons md-account_circle"></i> Profile </a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-settings"></i> Settings</a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-local_shipping"></i> My orders</a>
            @endif
            <hr>
            <a href="02.page-index-b.html#"> <i class="material-icons md-info"></i> About us</a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-chat"></i> Help &amp; support </a>
            <a href="02.page-index-b.html#"> <i class="material-icons md-local_police"></i> Services </a>
            @if(Auth::check())
            <hr>
            <a href="{{ url('logout') }}"> <i class="material-icons md-local_police"></i> Logout </a>
            @endif
      </nav>
    </article> <!-- offcanvas-body .// -->
 </aside> <!-- offcanvas.// -->