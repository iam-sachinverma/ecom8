@if(isset($page_name) && $page_name=="index")
	<header class="app-header onlight fixed-top">
		
		<a href="02.page-index-b.html#offcanvas_left_123" data-bs-toggle="offcanvas" role="button" class="btn-header">
			<i class="material-icons md-menu"></i>
		</a>
		
		<a href="{{ url('/') }}"><h5 class="title-header text-dark">  PantryShop  </h5></a>
		
		@if(Auth::check())
			<a href="{{ url('/account') }}" class="btn-header"> 
				<i class="material-icons md-account_circle"></i> 
			</a> 
		@else
			<a href="{{ url('/login-register') }}" class="btn-header"> 
				Login &nbsp; 
			</a>
	    @endif		
	

	</header> <!-- app-header.// -->
@endif	
