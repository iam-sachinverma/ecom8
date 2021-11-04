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
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form name="productForm" id="productForm" @if(empty($productdata['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productdata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
              <div class="col-md-6">

                <div class="form-group">
                  <label>Select Category</label>
                  <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($categories as $section)
                     <optgroup label="{{ $section['name'] }}"></optgroup>
                      @foreach($section['categories'] as $category)
                        <option value="{{ $category['id'] }}" 
                          @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected=""
                          @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id']) selected=""
                          @endif> &nbsp;&nbsp;
                          {{ $category['category_name'] }}
                        </option>
                        @foreach($category['subcategories'] as $subcategory)
                          <option value="{{ $subcategory['id'] }}"
                            @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" 
                            @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$subcategory['id']) selected="" 
                            @endif> &nbsp;&nbsp;&nbsp;&nbsp;&#8594;&nbsp;
                            {{ $subcategory['category_name'] }}
                          </option> 
                        @endforeach
                      @endforeach                    
                    @endforeach
                  </select>
                </div>
              
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name"
                  @if(!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}" 
                  @else value="{{ old('product_name') }}" @endif>
                </div>
                
              </div>
            
              <div class="col-md-6">
                
                <div class="form-group">
                  <label for="brand_id">Select Brand</label>
                  <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($brands as $brand)
                      <option value="{{ $brand['id'] }}"
                        @if(!empty($productdata['brand_id']) && $productdata['brand_id']==$brand['id']) selected=""
                        @endif>
                        {{ $brand['name'] }}
                      </option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="product_code">Product Code</label>
                  <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code"
                  @if(!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}"
                  @else value="{{ old('product_code') }}" @endif>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="product_price">Product Price</label>
                  <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price"
                  @if(!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}"
                  @else value="{{ old('product_price') }}" @endif>
                </div>

              </div>
          
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="product_discount">Product Discount (%)</label>
                  <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter Product Discount"
                  @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}" 
                  @else value="{{ old('product_discount') }}" @endif>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="main_image">Product Main Image</label>
                  <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="main_image" name="main_image">
                        <label class="custom-file-label" for="main_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>   
                    </div>
                    <small id="main_image" class="form-text text-muted">
                      Recommended Image Size: Width:1000px, Height:1000px 
                    </small>
                     @if(!empty($productdata['main_image']))
                      <div>
                        <img style="width:80px; margin-top:9px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}">&nbsp;
                        <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordid="{{ $productdata['id'] }}">Delete Image</a>
                      </div>
                     @endif
                </div>
              </div>  

              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="product_video">Product video</label>
                  <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_video" name="product_video">
                        <label class="custom-file-label" for="product_video">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div> 
                    </div>
                    @if(!empty($productdata['product_video']))
                      <div>
                        <br><a href="{{ url('videos/product_videos/'.$productdata['product_video']) }}" download>Download</a> &nbsp;|&nbsp;
                        <a class="confirmDelete" href="javascript:void(0)" record="product-video" recordid="{{ $productdata['id'] }}">Delete Video</a>
                      </div>
                    @endif
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="description">Product Description</label>
                  <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($productdata['description'])) {{ $productdata['description'] }} 
                    @else {{ old('description') }} @endif</textarea>
                </div>
              
              </div>
          
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="meta_description">Meta Description</label>
                  <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_description'])) {{ $productdata['meta_description'] }} 
                    @else {{ old('meta_description') }} @endif</textarea>
                </div>
                
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="meta_title">Meta Title</label>
                  <textarea id="meta_title" name="meta_title" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_title'])) {{ $productdata['meta_title'] }} 
                    @else {{ old('meta_title') }} @endif</textarea>
                </div>
              
              </div>
              
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="meta_keywords">Meta Keywords</label>
                  <textarea id="meta_keywords" name="meta_keywords" class="form-control" rows="3" placeholder="Enter ...">@if(!empty($productdata['meta_keywords'])) {{ $productdata['meta_keywords'] }} 
                    @else {{ old('meta_keywords') }} @endif</textarea>
                </div>
                
              </div>
            </div>

            <h5 class="mt-3 mb-3">Filter Section:</h5>

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                  <label for="cuisine">Cuisine</label>
                  <select name="cuisine" id="cuisine" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($cuisineArray as $cuisine)
                      <option value="{{ $cuisine }}"
                        @if(!empty($productdata['cuisine']) && $productdata['cuisine']==$cuisine) selected=""
                        @endif>
                        {{ $cuisine }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="foodpreference">Food Preference</label>
                  <select name="foodpreference" id="foodpreference" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($foodpreferenceArray as $foodpreference)
                      <option value="{{ $foodpreference }}"
                        @if(!empty($productdata['foodpreference']) && $productdata['foodpreference']==$foodpreference) selected=""
                        @endif>
                        {{ $foodpreference }}
                      </option>
                    @endforeach
                  </select>
                </div>

              </div>

              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <select name="country" id="country" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($countryArray as $country)
                      <option value="{{ $country }}"
                        @if(!empty($productdata['country']) && $productdata['country']==$country) selected=""
                        @endif>
                        {{ $country }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>
            
            <div class="form-group mt-4">
              <label for="is_featured">Featured Items&nbsp;&nbsp;</label>
              <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($productdata['is_featured']) && $productdata['is_featured']=="Yes") checked="" @endif>
            </div>
              
          </div><!-- Card Body   -->
        
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </div><!-- Card -->
      </form>
    </div>
  </section>

</div>

@endsection