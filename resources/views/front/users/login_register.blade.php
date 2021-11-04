@extends('layouts.front_layout.front_layout')
@section('content')

<section>

  <div class="p-3" style="background-image: url('images/front_images/b.svg'); background-repeat: no-repeat; background-size: cover; height: 50vh;">

    <a href="{{ url()->previous() }}" class="btn-header">
      <i class="material-icons md-arrow_back text-white"></i>
    </a>

    <div class="logo">
     <img src="images/front_images/b2.svg" class="img-fluid rounded mx-auto d-block my-4" alt="...">
    </div>
    
    <div class="title">
      <h1 class="fs-5 text-white text-center mt-5 mb-4">
        Login/Register
      </h1>
    </div>

    @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('error_message')}}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('success_message')}}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <strong>Create Account.</strong>&nbsp;<small>New to pantryshop?</small>
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">

            <form action="{{ url('/register') }}" method="post" id="registerForm">@csrf
              <div class="mb-3">
                <input type="text" id="name" name="name" class="form-control rounded-0" placeholder="Name">
              </div>
              <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="Email">
              </div>
              <div class="mb-3">
                <input type="text" id="mobile" name="mobile" class="form-control rounded-0" placeholder="Phone Number">
              </div>
              <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control rounded-0" placeholder="Set Password">
              </div>          
            </form>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit" form="registerForm">Continue</button>
            </div>
            
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="loginOne">
          <button class="accordion-button text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#login" aria-expanded="true" aria-controls="login">
            <strong>Sign-In.</strong>&nbsp; <small> Already a customer ? </small>  
          </button>
        </h2>
        <div id="login" class="accordion-collapse collapse show" aria-labelledby="loginOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">

            <form action="{{ url('/login') }}" method="post" id="loginForm">@csrf
              <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="Email">
              </div>
              <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control rounded-0" placeholder="Password">
              </div>
            </form> 
            <div class="row">
              <div class="form-check mb-3 col ms-1">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <small><label class="form-check-label" for="flexCheckDefault">
                  Show Password
                </label></small>
              </div>
              <div class="col text-end"><small><a href="{{ url('forgot-password') }}">Forgot Password  ?</a></small></div>
            </div>   
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit" form="loginForm">Continue</button>
            </div>
            
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

@endsection