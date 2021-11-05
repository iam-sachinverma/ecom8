@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm">
	
	<a href="javascript:history.go(-1)" class="btn-header">
		<i class="material-icons md-arrow_back"></i>
	</a>
	
	<h5 class="title-header">  {{ $cmsPageDetails['title'] }}  </h5>
	
	<a href="09.page-listing-e.html#" class="btn-header"> 
		<i class="material-icons md-search"></i> 
 	</a> 

</header> <!-- app-header.// -->

<main class="app-content">

<section id="cmsPages">
    <h1>{{ $cmsPageDetails['title'] }}</h1>
    
    <p>
        <?php echo nl2br($cmsPageDetails['description']); ?>
    </p>
</section>


</main> <!-- app-content.// -->




@endsection