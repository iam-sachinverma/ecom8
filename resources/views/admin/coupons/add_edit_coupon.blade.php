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

            @if(Session::has('error_message'))
              <div class="alert alert-warning alert-dismissible rounded-0" style="margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ Session::get('error_message')}}</strong>
              </div>
            @endif

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupons</li>
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
                <h3 class="card-title">{{ $title }}</h3>
              </div>
              <!-- /.card-header -->
              <form name="couponForm" id="couponForm" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}" @endif method="post">@csrf
                <div class="card-body">

                  <div class="row"><!-- /.Row 1 -->
                    
                      <div class="col-12 col-sm-6">
                        @if(empty($coupon['coupon_code']))
                          <div class="form-group">
                            <label for="coupon_option">Coupon Option</label>
                            <div class="form-check">
                                <input class="form-check-input" checked type="radio" name="coupon_option" id="AutomaticCoupon" value="Automatic">
                                <label class="form-check-label" for="AutomaticCoupon">
                                  Automatic radio
                                </label>
                            </div>
                            <div class="form-check">   
                                <input class="form-check-input" type="radio" name="coupon_option" id="ManualCoupon" value="Manual">
                                <label class="form-check-label" for="ManualCoupon">
                                  Manual radio
                                </label>
                            </div>
                          </div>  
                          
                          <div class="form-group" style="display: none;" id="couponField">
                            <label class="mb-3" for="coupon_code">Coupon Code</label>
                            <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter coupon_code">
                          </div>
                        @else
                          {{-- Edit Coupon --}}
                          <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                          <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">

                          <div class="form-group">
                            <label class="mb-3" for="coupon_code">Coupon Code : &nbsp;&nbsp;</label>
                            <code><span>{{ $coupon['coupon_code'] }}</span></code>
                          </div>
                        @endif

                        <div class="form-group">
                          <label for="amount_type">Amount Type</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="amount_type" value="Percentage"
                              @if(isset($coupon['amount_type']) && $coupon['amount_type']=="Percentage" ) checked="" @endif>
                              <label class="form-check-label" for="percentage">
                                Percentage&nbsp;( in % )
                              </label>
                          </div>
                          <div class="form-check">   
                              <input class="form-check-input" type="radio" name="amount_type" value="Fixed"
                              @if(isset($coupon['amount_type']) && $coupon['amount_type']=="Fixed" ) checked="" @endif>
                              <label class="form-check-label" for="fix">
                                Fixed&nbsp;( in INR )
                              </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="coupon_type">Coupon Type</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="coupon_type" value="Multiple Times"
                              @if(isset($coupon['coupon_type']) && $coupon['coupon_type']=="Multiple Times" ) checked=""
                              @endif>
                              <label class="form-check-label" for="Multiple_Times">
                                Multiple Times
                              </label>
                          </div>
                          <div class="form-check">   
                              <input class="form-check-input" type="radio" name="coupon_type" value="Single Times"
                              @if(isset($coupon['coupon_type']) && $coupon['coupon_type']=="Single Times" ) checked="">
                              @elseif(!isset($coupon['coupon_type'])) checked="" 
                              @endif
                              <label class="form-check-label" for="Single_Times">
                                Single Times
                              </label>
                          </div>
                        </div> 

                      </div> 

                    <div class="col-12 col-sm-6">

                      <div class="form-group">
                        <label class="mb-3" for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required=""
                        @if(isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif>
                      </div>

                      <div class="form-group">
                        <label class="mb-3" for="categories">Select Users</label>
                        <select name="users[]" class="form-control select2" multiple="">
                          <option value="">Select Users</option>
                          @foreach($users as $user)
                           <option value="{{ $user['email'] }}" @if(in_array($user['email'],$selUsers)) selected="" @endif>
                            {{ $user['email'] }}
                           </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="mb-2" for="coupon_code">Expiry Date</label>
                        <input type="text" class="form-control" name="expiry_date" id="expiry_date"  placeholder="Enter Expiry Date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required=""
                        @if(isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @endif> 
                      </div>

                    </div>  
                    
                  </div><!-- /.Row 1 -->

                </div><!-- Card-Body -->

                <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>
            </div>
            <!-- card -->
          </div>
          <!-- col -->
        </div>
        <!-- row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection