@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Catalogues</h1>

          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible rounded-0" style="margin-top: 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type:none;">{{ $error }}</li>
                    @endforeach
                </strong>
            </div>
          @endif

          @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible rounded-0" style="margin-top: 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>{{ Session::get('success_message')}}</strong>
            </div>
          @endif
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Shipping Charges</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Update Shipping Address of <strong>{{ $shippingDetails['state'] }} </strong>
                  </h3>
            </div>
            <!-- /.card-header -->
            <form name="shippingForm" id="shippingForm" action="{{ url('admin/edit-shipping-charges/'.$shippingDetails['id']) }}" method="post">@csrf
              <div class="card-body">
                  
                <div class="row mt-3">

                  <div class="col-md-6">
                    <div class="form-group"> 
                      <label for="shipping_state">State Name</label>
                      <input readonly class="form-control" name="shipping_state" value="{{ $shippingDetails['state'] }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group"> 
                      <label for="shipping_state">District Name</label>
                      <input readonly class="form-control" name="shipping_district" value="{{ $shippingDetails['district'] }}">
                    </div>
                  </div>

                  <!-- 0 to 500 gm  -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="0_500gm">Shipping Charges (0 - 500gm)</label>
                          <input type="text" class="form-control" name="0_500gm" id="0_500gm" placeholder="Enter Shipping Charge"
                          @if(!empty($shippingDetails['0_500gm'])) value="{{ $shippingDetails['0_500gm'] }}"
                          @else value="{{ old('0_500gm') }}" @endif>
                      </div>
                  </div>

                  <!-- 501 to 1000 gm -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="501_1000gm">Shipping Charges (501 - 1000gm)</label>
                          <input type="text" class="form-control" name="501_1000gm" id="501_1000gm" placeholder="Enter Shipping Charge"
                          @if(!empty($shippingDetails['501_1000gm'])) value="{{ $shippingDetails['501_1000gm'] }}"
                          @else value="{{ old('501_1000gm') }}" @endif>
                      </div>
                  </div>

                  <!-- 1001 to 2000 gm -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="1001_2000gm">Shipping Charges (1001 - 2000gm)</label>
                          <input type="text" class="form-control" name="1001_2000gm" id="1001_2000gm" placeholder="Enter Shipping Charge"
                          @if(!empty($shippingDetails['1001_2000gm'])) value="{{ $shippingDetails['1001_2000gm'] }}"
                          @else value="{{ old('1001_2000gm') }}" @endif>
                      </div>
                  </div>

                  <!-- 2001 to 5000 gm -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="2001_5000gm">Shipping Charges (2001 - 5000gm)</label>
                          <input type="text" class="form-control" name="2001_5000gm" id="2001_5000gm" placeholder="Enter Shipping Charge"
                          @if(!empty($shippingDetails['2001_5000gm'])) value="{{ $shippingDetails['2001_5000gm'] }}"
                          @else value="{{ old('2001_5000gm') }}" @endif>
                      </div>
                  </div>

                  <!-- above to 5000 gm -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="above_5000gm">Shipping Charges (above  5000gm)</label>
                          <input type="text" class="form-control" name="above_5000gm" id="above_5000gm" placeholder="Enter Shipping Charge"
                          @if(!empty($shippingDetails['above_5000gm'])) value="{{ $shippingDetails['above_5000gm'] }}"
                          @else value="{{ old('above_5000gm') }}" @endif>
                      </div>
                  </div>

                  <!-- COD METHOD -->
                  <div class="col-md-6">
                    <div class="form-group mx-4 my-5">
                      <label for="COD">COD&nbsp;&nbsp;</label>
                      <input type="checkbox" name="COD" id="COD" value="Yes"
                      @if(!empty($shippingDetails['COD']) && $shippingDetails['COD']=="Yes") checked="" value="{{ $shippingDetails['COD'] }}" 
                      @else value={{ old('COD') }}
                      @endif>
                    </div>
                  </div>
                  
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>  
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection