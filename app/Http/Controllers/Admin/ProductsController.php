<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use Session;
use Image;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page','products');
        $products = Product::with(['category','section'])->get();
       /* $products = json_decode(json_encode($products));
        echo "<pre>"; print_r($products); die;*/
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id){
        // Delete Product
        Product::where('id',$id)->delete();
        $message = 'Product has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();
    }

    public function addEditProduct(Request $request, $id=null){
        if($id==""){
            $title = "Add Product";
            $product = new Product;
            $productdata = array();
            $message =  "Product Added Successfully";  
        }else{
            $title = "Edit Product";
            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata),true);
            //echo "<pre>"; print_r($productdata); die;
            $product = Product::find($id);
            $message =  "Product Updated Successfully";  
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;  

            //Product Validations
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'brand_id.required' => 'Brand is required',
                'product_name.required' => 'Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Enter Valid Product Code',
                'product_price.required' => 'Product Price is required',
                'product_price.numeric' => 'Enter Valid Product Price',

            ];
            $this->validate($request,$rules,$customMessages);

            if(empty($data['is_featured'])){
                $is_featured = "No";
            }else{
                $is_featured = "Yes";
            }
            //echo $is_featured; die;

            //Upload Product Images
            if($request->hasFile('main_image')){
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()){
                    //Upload Images
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/product_images/large/'.$imageName;//Zoom Details Image
                    $medium_image_path = 'images/product_images/medium/'.$imageName;//main Image
                    $small_image_path = 'images/product_images/small/'.$imageName;// thumbnail Image
                     //Upload Large Images 
                    Image::make($image_tmp)->save($large_image_path); // W:1000 H:1000
                     //Upload Images after Resize Small and Medium
                    Image::make($image_tmp)->resize(370,370)->save($medium_image_path);
                    Image::make($image_tmp)->resize(156,156)->save($small_image_path);
                    //Save Image In DB
                    $product->main_image = $imageName;
                }
            }

            //Upload Product Video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    // Upload Video
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->extension();
                    $videoName = $video_name.'-'.rand().'.'.$extension;
                    $video_path = 'videos/product_videos';
                    $video_tmp->move($video_path,$videoName);
                    //Save Video in DB
                    $product->product_video = $videoName;
   
                }
            }
        
          //Save Product Details in Database
          $categoryDetails = Category::find($data['category_id']);
          $product->section_id = $categoryDetails['section_id'];
          $product->brand_id = $data['brand_id'];
          $product->category_id = $data['category_id'];
          $product->product_code = $data['product_code'];
          $product->product_name = $data['product_name'];
          $product->product_price = $data['product_price'];
          $product->product_discount = $data['product_discount'];
          $product->description = $data['description'];
          $product->cuisine = $data['cuisine'];
          $product->foodpreference = $data['foodpreference'];
          $product->country = $data['country'];
          $product->meta_title = $data['meta_title'];
          $product->meta_description = $data['meta_description'];
          $product->meta_keywords = $data['meta_keywords'];
          $product->is_featured = $is_featured;
          $product->status = 1;
          $product->save();
          //echo "<pre>"; print_r($product); die;
          session::flash('success_message', $message);
          return redirect('admin/products'); 
        }

        // Product Array
        $productFilters = Product::productFilters();
        //echo "<pre>"; print_r($productFilters); die;
        $cuisineArray = $productFilters['cuisineArray'];
        $countryArray = $productFilters['countryArray'];
        $foodpreferenceArray = $productFilters['foodpreferenceArray'];

        //Sections with Categories and Sub Categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        //echo "<pre>"; print_r($categories); die;

        $brands = Brand::where('status',1)->get();
        $brands = json_decode(json_encode($brands), true);

        return view('admin.products.add_edit_product')->with
         (compact('title','categories','productdata','brands','cuisineArray','countryArray','foodpreferenceArray'));
    }

    public function deleteProductImage($id){
        // Get Product Image
        $productImage = Product::select('main_image')->where('id', $id)->first();

        // Get Product Image Path
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete Product Small Image if exists
        if(file_exists($small_image_path.$productImage->main_image)){
            unlink($small_image_path.$productImage->main_image);
        }
        // Delete Product Medium Image if exists
        if(file_exists($medium_image_path.$productImage->main_image)){
            unlink($medium_image_path.$productImage->main_image);
        }
        // Delete Product large Image if exists
        if(file_exists($large_image_path.$productImage->main_image)){
            unlink($large_image_path.$productImage->main_image);
        }

        // Delete Product Image from SQL table
        Product::where('id',$id)->update(['main_image'=>'']);

        $message = 'Product image has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();

    }

    public function deleteProductVideo($id){
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get Product Video Path
        $product_video_path = 'videos/product_videos/';

        // Delete Product Video from product_videos folder if exists
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }

        // Delete Product Video from SQL table
        Product::where('id',$id)->update(['product_video'=>'']);

        $message = 'Product Video has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();

    }

  // Product ATTRIBUTES

    public function addAttributes(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['sku'] as $key => $value){
                if(!empty($value)){

                   // SKU already exists check
                   $attrCountSKU = ProductsAttribute::where('sku',$value)->count();
                   if($attrCountSKU>0){
                       $message = 'SKU already exists';
                       session::flash('error_message',$message);
                       return redirect()->back();
                   }

                   // SIZE already exists check
                   $attrCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                   if($attrCountSize>0){
                       $message = 'Size already exists';
                       session::flash('error_message',$message);
                       return redirect()->back();
                   }

                   $attribute = new ProductsAttribute;
                   $attribute->product_id = $id;
                   $attribute->sku = $value;
                   $attribute->size = $data['size'][$key];
                   $attribute->weight = $data['weight'][$key];
                   $attribute->price = $data['price'][$key];
                   $attribute->discount = $data['discount'][$key];
                   $attribute->stock = $data['stock'][$key];
                   $attribute->status = 1;
                   $attribute->save();
               }

            }

           $success_message = 'Product Attributes Added Successfully';
           session::flash('success_message',$success_message);
           return redirect()->back();
            
        }

        $productdata = Product::select('id','product_name','product_code','main_image','product_price','product_discount')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata),true);
        $title = "Product Attributes";
        //echo "<pre>"; print_r($productdata); die;
        return view('admin.products.add_attributes')->with(compact('productdata','title'));
    }

    public function editAttributes(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['attrId'] as $key => $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(
                        ['weight'=>$data['weight'][$key],
                         'price'=>$data['price'][$key],
                         'discount'=>$data['discount'][$key],
                         'stock'=>$data['stock'][$key]
                        ]
                    );   
                }
            }
            $success_message = 'Attributes Updated Successfully';
            session::flash('success_message',$success_message);
            return redirect()->back();
        }
    }

    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function deleteAttribute($id){
        // Delete Attribute
        ProductsAttribute::where('id',$id)->delete();
        $message = 'Attribute has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();
    }

   
  // Product IMAGES
  
    public function addImages(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
            if($request->hasFile('images')){
                $images = $request->file('images');
                    foreach($images as $key => $image){
                        $productImage = new ProductsImage;
                        $image_tmp = Image::make($image);
                        //$originalName = $image->getClientOriginalName();
                        $extension = $image->getClientOriginalExtension();
                        $imageName = rand(111,9999).time().".".$extension;
                        $large_image_path = 'images/product_images/large/'.$imageName;//Zoom Details Image
                        $medium_image_path = 'images/product_images/medium/'.$imageName;//main Image
                        $small_image_path = 'images/product_images/small/'.$imageName;// thumbnail Image
                        //Upload Large Images 
                        Image::make($image_tmp)->save($large_image_path); // W:1000 H:1000
                        //Upload Images after Resize Small and Medium
                        Image::make($image_tmp)->resize(370,370)->save($medium_image_path);
                        Image::make($image_tmp)->resize(156,156)->save($small_image_path);
                        //Save Image In DB
                        $productImage->image = $imageName;
                        $productImage->product_id = $id;
                        $productImage->save();
                    }
                
                $message = 'Product Images has been successfully uploaded';
                session::flash('success_message',$message);
                return redirect()->back();
            }
        }

        $productdata = Product::with('images')->select('id','product_name','product_code','main_image')->find($id);
        $productdata = json_decode(json_encode($productdata),true);
        //echo "<pre>"; print_r($productdata); die;

        $attributes = ProductsAttribute::where(['product_id'=>$productdata['id'],'status'=>1])->get()->toArray();
        //echo "<pre>"; print_r($attributes); die;

        $title = "Product Images";
        return view('admin.products.add_images')->with(compact('title','productdata'));    
    }

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }

    public function deleteImage($id){
        // Get Product Image
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        // Get Product Image Path
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete Product Small Image if exists
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        // Delete Product Medium Image if exists
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        // Delete Product large Image if exists
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Product Image from SQL table
        ProductsImage::where('id',$id)->delete();

        $message = 'Product image has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();

    }


}
