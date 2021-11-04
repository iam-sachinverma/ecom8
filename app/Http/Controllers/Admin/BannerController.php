<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Image;

class BannerController extends Controller
{
    public function banners(){
    	Session::put('page','banners');
    	$banners = Banner::get()->toArray();
    	//dd($banners); die;
    	return view('admin.banners.banners')->with(compact('banners'));
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id){
        // Get Banner Image
        $bannerImage = Banner::select('image')->where('id', $id)->first();

        // Get Banner Image Path
        $banner_image_path = 'images/banner_images/';
      
        // Delete Banner Small Image if exists
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }

        // Delete Banner Image from SQL table
        Banner::where('id',$id)->delete();

        $message = 'Banner has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();

    }

    public function addEditBanner(Request $request, $id=null){
    	if($id==""){
    		// Add Banner
    		$banner = new Banner;
    		$title = "Add Banner Image";
    		$message = "Banner Added Successfully";

    	}else{
    		// Edit Banner
    		$banner = Banner::find($id);
    		$title = "Edit Banner Image";
    		$message = "Banner Updated Successfully";
 
    	}

        if($request->isMethod('post')){
        	$data = $request->all();

            $rules = [
                'link' => 'required',
                'title' => 'required',
                'alt' => 'required',   
            ];
            $customMessages = [
                'link.required' => 'Link is required',
                'title.required' => 'Title is required',
                'alt.required' => 'Alt is required',                      
            ];
   
            $this->validate($request,$rules,$customMessages);

        	//echo "<pre>"; print_r($data); die;
        	$banner->link = $data['link'];
        	$banner->title = $data['title'];
        	$banner->alt = $data['alt'];

        	//Upload Banner Image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    //Upload Images
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(1111,9999).'.'.$extension;
                    $banner_image_path = 'images/banner_images/'.$imageName;
                
                    Image::make($image_tmp)->resize(640,280)->save($banner_image_path);
                    //Save Image In DB
                    $banner->image = $imageName;
                }
            }

            $banner->save();
            session::flash('success_message', $message);
            return redirect('admin/banners');
        }

    	return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }

    public function deleteBannerImage($id){
        // Get Banner Image
        $bannerImage = Banner::select('image')->where('id', $id)->first();

        // Get Banner Image Path
        $banner_image_path = 'images/banner_images/';

        // Delete Banner Image from images folder if exists
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }

        // Delete Banner Image from SQL table
        Banner::where('id',$id)->update(['image'=>'']);

        $message = 'Banner image has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();

    }

}
