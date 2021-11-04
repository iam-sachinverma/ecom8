@extends('layouts.front_layout.front_layout')
@section('content')


<header class="app-header onlight fixed-top shadow-sm">
		
  <a href="{{ url()->previous() }}" class="btn-header">
   <i class="material-icons md-arrow_back text-dark"></i>
  </a>

</header> <!-- app-header.// -->

<main class="app-content">

  <section class="p-3 bg-primary">

    <figure class="icontext align-items-center mr-4" style="max-width: 300px;">
        <figcaption class="text text-white">
            <p class="h5 title mb-1">{{ Auth::user()->name }}</p>
            <p class="text-white-50 lh-sm">+91{{ Auth::user()->mobile }} <br> {{ Auth::user()->email }}</p>
        </figcaption>
    </figure>
    
  </section>

  @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
        <strong>{{ Session::get('success_message')}}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
  
  <section class="p-3">
    
    <form action="29.page-profile-edit.html#" name="profile_form" id="profile_form">
  
    
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" required class="form-control" value="vosidiy">
      </div>
    
      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="tel" name="telefon" class="form-control" value="+998" pattern="^[+][0-9]{12}">
      </div>
    
      {{-- <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" autofocus autocomplete="on" class="form-control" value="myname@gmail.com">
      </div>
   --}}
      <div class="mb-3">
        <button class="btn btn-light">  Update </button>
      </div>
    
    </form>

    <div class="mb-3 mt-4">
      <a href="{{ url('account/change-password') }}"> <button class="btn btn-light w-100">  Change password</button> </a>
    </div>
    
    <div class="mb-3">
        <button class="btn btn-light w-100"> Deactivate Account</button>
    </div>
    
    <br>
    
  </section>
    
</main> <!-- app-content.// -->

@endsection
