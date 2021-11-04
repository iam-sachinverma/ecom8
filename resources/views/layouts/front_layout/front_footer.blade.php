@if(isset($page_name) && $page_name=="index")
	<nav class="nav-bottom">
		<a href="{{ url('/') }}" class="nav-link active">
			<i class="icon material-icons md-home"></i><span class="text">Home</span>
		</a>
		<a href="10.page-category-a.html" class="nav-link">
			<i class="icon material-icons md-apps"></i><span class="text">Category</span>
		</a>
	
		<a href="{{ url('/cart') }}" class="nav-link position-relative">
           
			<span class="badge rounded-pill bg-info text-dark position-absolute top-2 start-100 translate-middle p-1"> {{ totalCartItems() }}</span>
		
			 <i class="icon material-icons md-shopping_cart"></i> 
			<span class="text">Cart</span>
		</a>
		
		<a href="05.page-listing-a.html" class="nav-link">
			<i class="icon material-icons md-favorite"></i><span class="text">Saved</span>
		</a>
	</nav> <!-- nav-bottom -->
@endif	