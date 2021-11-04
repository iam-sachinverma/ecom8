@extends('layouts.front_layout.front_layout')
@section('content')

<header class="app-header ondark fixed-top bg-primary">
	
	<a href="javascript:history.go(-1)" class="btn-header">
		<i class="material-icons md-arrow_back"></i>
	</a>
	
	<h5 class="title-header"> My Address </h5>

	<a href="{{ url('/add-edit-delivery-address') }}" class="btn-header"> 
		<i style="font-size: 18px;" class="bi bi-plus-lg"></i> 
 	</a> 

</header> <!-- app-header.// -->

<div class="px-2">
	@if(Session::has('success_message'))
	<div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert" style="margin-top: 10px;">
		<strong>{{ Session::get('success_message')}}</strong>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif
</div>


<main class="app-content">

<section class="p-2">
	<div class="d-grid gap-2">
		<a class="text-start btn-light btn-sm mt-3 text-dark" href="{{ url('/add-edit-delivery-address') }}" role="button">
			Add a new address 
		</a>
	</div>
</section>

<section>
	<ul class="p-2 mt-1 list-menu">
		@foreach($deliveryAddresses as $address)
		<li class="mb-2">
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row g-0">
				  <div class="col">
					<div class="card-body">
					  <h6 class="card-title"><strong>Address Type: &nbsp;</strong>{{ $address['address_type'] }}<br></h6>
					  <p>{{ $address['name'] }}<br>
						{{ $address['address'] }} , {{ $address['area'] }} , {{ $address['state'] }}-{{ $address['pincode'] }}<br>
						ph: {{ $address['mobile'] }}
					  </p>
					</div>
					<div class="card-footer bg-body border-top-0 d-flex">
					
						<a class="btn btn-outline-light py-1 btn-sm" href="{{ url('/add-edit-delivery-address/'.$address['id']) }}" role="button">
						  Edit
						</a>
					    <div class="mx-4">&nbsp;</div>
						<a class="btn btn-outline-danger btn-sm py-1" href="{{ url('/delete-delivery-address/'.$address['id']) }}" role="button">
						  Delete
						</a>
							 
					</div> 
				  </div>
				</div>
			</div> 
		</li>
		<hr>
		@endforeach
	</ul>
</section>

<br>

</main> <!-- app-content.// -->

@endsection
