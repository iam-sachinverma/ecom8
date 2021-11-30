@extends('layouts.front_layout.front_layout')
@section('content')

<!-- <section>

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

</section> -->

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


<div class="container py-4 py-lg-5 my-4">
  <div class="row">
    <div class="col-md-6">
      <div class="card border-0 shadow">
        <div class="card-body">
          <h2 class="h4 mb-1">Sign in</h2>
          <div class="py-3">
            <h3 class="d-inline-block align-middle fs-base fw-medium mb-2 me-2">With social account:</h3>
            <div class="d-inline-block align-middle"><a class="btn-social bs-google me-2 mb-2" href="#" data-bs-toggle="tooltip" title="Sign in with Google"><i class="ci-google"></i></a><a class="btn-social bs-facebook me-2 mb-2" href="#" data-bs-toggle="tooltip" title="Sign in with Facebook"><i class="ci-facebook"></i></a><a class="btn-social bs-twitter me-2 mb-2" href="#" data-bs-toggle="tooltip" title="Sign in with Twitter"><i class="ci-twitter"></i></a></div>
          </div>
          <hr>
          <h3 class="fs-base pt-4 pb-2">Or using form below</h3>
          <form  action="{{ url('/login') }}" method="post" id="loginForm">@csrf

            <div class="input-group mb-3">
              <i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
              <input class="form-control rounded-start" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group mb-3">
              <i class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
              <div class="password-toggle w-100">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between">
              <div class="form-check">
               
              </div><a class="nav-link-inline fs-sm" href="{{ url('forgot-password') }}">Forgot password?</a>
            </div>
            <hr class="mt-4">
            <div class="text-end pt-4">
              <button class="btn btn-primary" type="submit" form="loginForm">
                <i class="ci-sign-in me-2 ms-n21"></i>Sign In
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6 pt-4 mt-3 mt-md-0">
      <h2 class="h4 mb-3">No account? Sign up</h2>
      <p class="fs-sm text-muted mb-4">Registration takes less than a minute but gives you full control over your orders.</p>
      <form action="{{ url('/register') }}" method="post" id="registerForm">@csrf
        
        <div class="row gx-4 gy-3">
          <div class="col-sm-6">
            <label class="form-label" for="name">First Name</label>
            <input class="form-control" type="text" name="name" id="name">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="email">E-mail Address</label>
            <input class="form-control" type="email" name="email" id="email">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="mobile">Phone Number</label>
            <input class="form-control" type="number" name="mobile" id="mobile">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
          <div class="col-12 text-end">
            <button class="btn btn-primary" form="registerForm" type="submit"><i class="ci-user me-2 ms-n1"></i>Sign Up</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection