<?php

namespace Shura\Article\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    public static function buildMenu(){
//      $menu = static::all();
        $categories = Category::where('content_type',1)->get();
        $m = '';
        foreach ($categories as $category) {
            if($category->parent == 0) {
                $m.='<li class="dropdown-submenu">';
                $m.= '<a href="'.route('list_products_by_category',['slug'=>$category->slug,'locale'=>App()->getLocale()!=config('app.fallback_locale')?App()->getLocale():'']).'" class="dropdown-toggle" data-toggle="dropdown">'.$category->name.'</a>';
                $m.= ' <ul class="dropdown-menu">';
                foreach ($categories as $subCategory) {
                    if($subCategory->parent == $category->id){
                        $m.='<li class="">';
                        $m.= '<a href="'.route('list_products_by_category',['slug'=>$subCategory->slug,'locale'=>App()->getLocale()!=config('app.fallback_locale')?App()->getLocale():'']).'">'.$subCategory->name.'</a>';
                        $m.='</li>';
                    }


                }
                $m.= '</ul>';
                $m.='</li>';
            }
        }
        $menu = new \stdClass();
        $menu->cat = $m;
        return $menu;
    }
}
