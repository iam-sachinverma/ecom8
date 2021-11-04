@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header ondark bg-primary fixed-top">
  
    <a href="javascript:history.go(-1)" class="btn-header">
      <i class="material-icons md-arrow_back"></i>
    </a>
    
    <h6 class="title-header"> {{ $title }} </h6>
    
    <div class="header-right">
       
    </div>
  
</header> <!-- app-header.// -->

<?php echo url()->previous(); ?>

<main class="app-content">
  
  <section class="p-3">
  
  <form id="deliveryAddressForm" 
    @if(empty($address['id'])) action="{{ url('/add-edit-delivery-address') }}" @else 
    action="{{ url('/add-edit-delivery-address/'.$address['id']) }}" @endif method="POST">@csrf
    
    <div class="form mb-3">
      <small><label for="name" for="validationCustom01" class="form-label">Name</label></small>
      <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Full Name"
       value="{{ $address['name'] }}" required="">
    </div>
  
    <div class="form mb-3">
        <small><label for="phone" class="form-label">Phone number</label></small>
        <input type="number" name="mobile" id="mobile" class="form-control form-control-sm rounded-0" placeholder="Phone number"
         value="{{ $address['mobile'] }}" required="">
    </div>

    <div class="mb-3 row">
      <div class="col-6">
        <div class="form">
            <small><label for="pincode" class="form-label">Pincode</label></small>
            <input type="number" name="pincode" id="pincode" class="form-control form-control-sm rounded-0" placeholder="Pincode"
             value="{{ $address['pincode'] }}" required="">
        </div>
      </div>
      <div class="col-6">
        <div class="form">
            <small><label for="state" class="form-label">State</label></small>
            <input type="text" name="state" id="state" class="form-control form-control-sm rounded-0" placeholder="City" 
             value="{{ $address['state'] }}" style="text-transform:uppercase" required="">
        </div>

        <div class="form">
            <input type="hidden" name="district" id="district" class="form-control form-control-sm rounded-0" placeholder="City" 
             value="{{ $address['state'] }}" readonly>
        </div>
        
      </div>
    </div>
  
    <div class="form mb-3">
        <small><label for="address" class="form-label">Address</label></small>
        <input type="text" name="address" id="address" class="form-control form-control-sm rounded-0" placeholder="House No., Building Name" 
         value="{{ $address['address'] }}" required="">
    </div>
  
    <div class="form mb-2">
        <small><label for="area" class="form-label">Area</label></small>
        <input type="text" name="area" id="area" class="form-control form-control-sm rounded-0" placeholder="Road name, Area, Colony" 
         value="{{ $address['area'] }}" required="">
    </div>

  
    <div class="form mb-4">
        <small id="addLandmark">
          <label for="landmark" class="form-label">+&nbsp;&nbsp;Add Nearby Famous Landmark/Shop/Mall</label>
        </small>
        <input type="text" id="landmark" name="landmark" class="form-control form-control-sm rounded-0" 
         @if (empty($address['landmark'])) style="display: none" @endif  placeholder="Enter nearby landmark/shop/mall"
         value="{{ $address['landmark'] }}">
    </div>
    
    <small><label for="addressType" class="mb-2">Type of address</label></small>
    <div class="form-group d-flex mb-3">
      <div class="form-check">
        <label class="form-check-label" for="addressHome">
          Home
        </label>
        <input class="form-check-input" type="radio" name="address_type" id="addressHome" value="Home"
        @if(isset($address['address_type']) && $address['address_type']=="Home" ) checked="" @endif>
      </div>
      <div class="form-check mx-3">
        <label class="form-check-label" for="addressOther">
          Other
        </label>
        <input class="form-check-input" type="radio" name="address_type" id="addressOther" value="Other"
        @if(isset($address['address_type']) && $address['address_type']=="Other" ) checked="" @endif> 
      </div>
    </div>
    
  
    <button type="submit" class="btn w-100 btn-primary"> Save Address </button>
  
  </form>
  
  <br><br>
  
  </section> 
  
</main> <!-- app-content.// -->



@endsection