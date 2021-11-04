@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header onlight fixed-top shadow-sm">
		
    <a href="{{ url()->previous() }}" class="btn-header">
     <i class="material-icons md-arrow_back text-dark"></i>
    </a>
    
    <h5 class="title-header text-center">  Change Password  </h5>
  
</header> <!-- app-header.// -->

<main class="app-content">

    <section class="p-3">
       
        <small><label class="form-label text-muted">Email ID</label></small>
        <p class="h6 fw-normal title mb-2">Sachinvermab@gmail.com</p>

        <small><label class="form-label text-muted">Mobile Number</label></small>
        <p class="h6 fw-normal subtitle">9891938668</p>
        <hr>
        
    </section>

    @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('error_message')}}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <section class="px-3">
    
        <form action="{{ url('/account/update-user-pwd') }}" method="POST" id="passwordForm">@csrf
      
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_pwd" id="current_pwd" required class="form-control" placeholder="Enter your current password">
            <span id="chkPwd"></span>
          </div>

          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="new_pwd" id="new_pwd" required class="form-control" placeholder="Enter new password">
          </div>
        
          <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm new password">
          </div>
        
        </form>
    
        <div class="mb-3 mt-4">
          <button class="btn btn-light w-100" type="submit" form="passwordForm"> Update password</button> 
        </div>
    
        <br>
        
    </section>

</main>

@endsection