<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function categories(){
        $getCatgeory = Category::select('id','category_name','parent_id','category_image','url')->where(['parent_id'=>'ROOT','status'=>1])->get()->toArray();
        return $getCatgeory;
    }
    
    public function subcategories(){
        return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }

    public static function catDetails($url){
        $catDetails = Category::select('id','parent_id','category_name','url'
        ,'meta_title','meta_description','meta_keywords')->with(['subcategories'=>
        function($query){
          $query->select('id','parent_id','category_name','url')->where('status',1);
        }])->where('url',$url)->first()->toArray();
        //dd($catDetails); die;

        // Breadcrumbs
        if($catDetails['parent_id']==0){
            $breadcrumbs = '<a href="'.url($catDetails['url']).'" >'.$catDetails['category_name'].'</a>';
        }else{
            $parentCatgeory = Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a href="'.url($parentCatgeory['url']).'" >'.$parentCatgeory['category_name'].'</a>
                            &nbsp;&nbsp;<a href="'.url($catDetails['url']).'" >'.$catDetails['category_name'].'</a>';
        }
    
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach($catDetails['subcategories'] as $key => $subcat){
            $catIds[] = $subcat['id'];
        }
        //dd($catIds); die;
        return array('catIds'=>$catIds,'catDetails'=>$catDetails,'breadcrumbs'=>$breadcrumbs);
    }
}
