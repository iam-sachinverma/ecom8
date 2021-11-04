@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm"><!--  Remove dark text in i tag  -->
  
	<a href="{{ url()->previous() }}" class="btn-header">
		<i class="material-icons md-arrow_back text-dark"></i>
	</a>
	
	<h5 class="title-header text-center text-dark">  Pantryshop  </h5>
	
</header> <!-- app-header.// -->

<section class="p-3 mt-2">

    @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('error_message') }}</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('success_message') }}</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="head mb-3">
        <h1 class="title-header text-dark fs-4 fw-normal">  Password Assistance </h1>
        <p class="mt-3">
        Enter the email address or mobile phone number associated with your Amazon account.
        </p>
    </div> 

    <form id="forgotPasswordForm" action="{{ url('/forgot-password') }}" method="post">@csrf
        <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="Your email address" required="">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Continue</button>
        </div>
    </form>

</section>



@endsection