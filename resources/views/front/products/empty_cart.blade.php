@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm">
		
    <a href="{{ url()->previous() }}" class="btn-header">
		<i class="material-icons md-arrow_back text-dark"></i>
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



<div>
    <h1>SOUL BRO HIIII</h1>
</div>


@endsection