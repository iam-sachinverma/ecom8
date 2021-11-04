@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
  <!-- Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Catalogues</h1>

          @if(Session::has('error_message'))
            <div class="alert alert-warning alert-dismissible rounded-0" style="margin-top: 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ Session::get('error_message')}}</strong>
            </div>
          @endif

          @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible rounded-0" style="margin-top: 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ Session::get('success_message')}}</strong>
            </div>
          @endif

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

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product Attributes</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid"><!-- Add Attribute -->
      <form name="addAttributeForm" id="addAttributeForm" action="{{ url('admin/add-attributes/'.$productdata['id']) }}" method="post">@csrf
        <div class="card card-default"><!-- Card -->
         
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            
            <div class="row">
              <div class="col-sm-6">

                <div class="form-group">
                  <label for="product_code">Product Code:</label>&nbsp;&nbsp; {{ $productdata['product_code'] }}
                </div>

                <div class="form-group">
                  <label for="product_name">Product Name:</label>&nbsp;&nbsp; {{ $productdata['product_name'] }}
                </div>

                <div class="form-group">
                  <label for="product_name">Product Main Price:</label>&nbsp;&nbsp; {{ $productdata['product_price'] }}
                  &nbsp;&nbsp; 
                  <span>Product Main Discount: {{ $productdata['product_discount'] }}</span>
                </div>
                
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <img class="img-fluid img-thumbnail" style="width:140px; max-height:120px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}">
                </div>
              </div>
            </div> 
             
            <div class="row mt-4">
              <div class="col-12">
                <div class="form-group">
                  <div class="field_wrapper">
                    <div>
                        <input id="sku" type="text" name="sku[]" value="" placeholder="SKU" style="width: 120px;" required=""/>
                        <input id="size" type="text" name="size[]" value="" placeholder="Size" style="width: 120px;" required=""/>
                        <input id="weight" step="any" type="number" name="weight[]" value="" placeholder="Weight" style="width: 120px;" required=""/>
                        <input id="price" step="any" type="number" name="price[]" value="" placeholder="Price" style="width: 120px;" required=""/>
                        <input id="discount" step="any" type="number" name="discount[]" value="" placeholder="Discount" style="width: 120px;" required=""/>
                        <input id="stock" type="number" name="stock[]" value="" placeholder="Stock" style="width: 120px;" required=""/>
                        <a href="javascript:void(0);" class="add_button" title="Add field">&nbsp;&nbsp;<b>Add</b></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

          </div>
        
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Attributes</button>
          </div>

        </div><!-- Card -->
      </form>
    </div><!-- Add Attribute -->


    <div class="container-fluid"><!-- Display And Edit Attribute -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Attributes</h3>
            </div>
            <form name="editAttributeForm" id="editAttributeForm" action="{{ url('admin/edit-attributes/'.$productdata['id']) }}" method="post">@csrf
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Stock</th> 
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($productdata['attributes'] as $attribute)
                  <input style="display: none;" type="text" name="attrId[]" value="{{ $attribute['id'] }}">
                  <tr>
                    <td>{{ $attribute['id'] }}</td>
                    <td>{{ $attribute['sku'] }}</td>
                    <td>{{ $attribute['size'] }}</td>
                    <td>
                      <input type="number" name="weight[]" value="{{ $attribute['weight'] }}" required="" style="width: 90px;">
                    </td>
                    <td>
                      <input type="number" name="price[]" value="{{ $attribute['price'] }}" required="" style="width: 90px;">
                    </td>
                    <td>
                      <input type="number" name="discount[]" value="{{ $attribute['discount'] }}" required="" style="width: 90px;">
                    </td>
                    <td>
                      <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required="" style="width: 90px;">
                    </td>
                    <td>
                      <a title="Delete Product Attribute" href="javascript:void(0)" class="confirmDelete" record="attribute" recordid="{{ $attribute['id'] }}"><i class="fas fa-trash-alt"></i></a>
                      &nbsp;
                      @if( $attribute['status'] == 1 )
                      <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                        <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                      @else
                      <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                        <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                      @endif 
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Action</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Attributes</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- Display And Edit Attribute -->

  </section>

</div>

@endsection