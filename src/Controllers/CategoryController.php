<?php
namespace Shura\Article\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shura\Article\Models\Article;
use Shura\Article\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::query()->paginate();
        return view($this->namespace.'::pages.categories.bo.list',['categories'=>$categories]);
    }
    public function create(Request $request){
        $categories = Category::all();
        return view($this->namespace.'::pages.categories.bo.edit',['categories'=>$categories]);
    }
    public function edit(Request $request,$id){
        $categories = Category::all();
        $category = $categories->where('id','=',$id)->first();
        return view($this->namespace.'::pages.categories.bo.edit',['categories'=>$categories,'category'=>$category]);
    }
    public function list_all_article(Request $request) {

    }
    public function detail(Request $request, $slug){


    }

    public function list_by_content_type(Request $request, $content_type){

    }
}