<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections(){
        Session::put('page','sections');
        $sections = Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function addEditSection(Request $request,$id=null){
        Session::put('page','sections');
        if($id==""){
            $title = "Add Section";
            $section = new Section;
            $message = "Section Added Successfully";
        }else{
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section Updated Successfully";
        }
        
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'section_name' => 'required',   
            ];
            $customMessages = [
                'section_name.required' => 'Section Name is required',      
            ];
   
         $this->validate($request,$rules,$customMessages);

         $section->name = $data['section_name'];
         $section->save();
 
         Session::flash('success_message',$message);
         return redirect('admin/sections');
        
        }
 
        return view('admin.sections.add_edit_section')->with(compact('title','section'));
    }
 
    public function deleteSection($id){
        Section::where('id',$id)->delete();
        $message = 'Section has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();
    }

    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
}
