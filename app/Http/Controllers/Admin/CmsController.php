<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Session;
use Validator;

class CmsController extends Controller
{
    public function cmspages(){
        Session::put('page','cms_pages');
        $cms_pages = CmsPage::get();
        return view('admin.pages.cms_pages')->with(compact('cms_pages'));
    }

    public function updateCmsPageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    public function addEditCmsPage(Request $request, $id=null){
        if($id==""){
            $title = "Add Cms Page";
            $cmspage = new CmsPage;
            $message = "CMS Page added Successfully";
        }else{
            $title = "Edit Cms Page";
            $cmspage = CmsPage::find($id); 
            $message = "CMS Page updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //Product Validations
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Enter Page title is required',
                'title.regex' => 'Enter Valid Page Title',
                'url.required' => 'Url is required',
                'description.required' => 'Description is required',

            ];
            $this->validate($request,$rules,$customMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->status = 1;
            $cmspage->save();

            session::flash('success_message', $message);
            return redirect('admin/cms-pages');
        }
        return view('admin.pages.add_edit_cmspage')->with(compact('title','cmspage'));
    }

    public function deleteCmsPage($id){
        CmsPage::where('id',$id)->delete();
        $message = 'Page has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();
    }
}
