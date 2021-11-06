@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header ondark bg-primary fixed-top">
	<a href="javascript:history.go(-1)" class="btn-header">
		<i class="material-icons md-arrow_back"></i>
	</a>
	
	<h5 class="title-header">  {{ $cmsPageDetails['title'] }}  </h5>
	
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

<main class="app-content">

<section class="bg">
	<h5 class="title-section">Great headline</h5>
	<div class="p-3">
	    <article class="card shadow-sm mb-3">
	    	<div class="card-body">
			   <?php echo nl2br($cmsPageDetails['description']); ?>
	    	</div>
	    </article>
	</div>
</section> 

<p class="text-center mx-3">
	<a href="index.html" class="btn w-100 btn-light"> 
		<i class="material-icons md-arrow_back"></i>  continue shopping
	</a>
</p>
<br>


</main> <!-- app-content end// -->


<nav class="nav-bottom">
	<a href="index.html" class="nav-link active">
		<i class="icon material-icons md-home"></i><span class="text">Home</span>
	</a>
	<a href="0.page-blank.html#" class="nav-link">
		<i class="icon material-icons md-apps"></i><span class="text">Category</span>
	</a>
	<a href="0.page-blank.html#" class="nav-link">
		<i class="icon material-icons md-favorite"></i><span class="text">Saved</span>
	</a>
	<a href="0.page-blank.html#" class="nav-link">
		<i class="icon material-icons md-account_circle"></i><span class="text">Profile</span>
	</a>
</nav> <!-- nav-bottom -->



@endsection