<?php
namespace Shura\Article\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shura\Article\Models\Article;
use Shura\Article\Models\Category;

class ArticleController extends Controller
{
    public function index(Request $request){
        $articles = DB::table('article')
            ->leftjoin('category','article.category_id','=','category.id')
            ->select('article.*','category.name as category_name')
            ->paginate(15);
        return view($this->namespace.'::pages.articles.bo.list',['articles'=>$articles]);
    }
    public function create(Request $request){
        $categories = Category::where('content_type','=',$this->content_type)->get();
        return view($this->namespace.'::pages.articles.bo.edit',['categories'=>$categories]);
    }
    public function edit(Request $request,$id){
        $categories = Category::where('content_type','=',$this->content_type)->get();
        $article = Article::find($id);
        return view($this->namespace.'::pages.articles.bo.edit',['article'=>$article,'categories'=>$categories]);
    }
    public function list_all_article(Request $request) {
        $articles = DB::table('article')
            ->leftjoin('category','article.category_id','=','category.id')
            ->select('article.*','category.name as category_name')
            ->paginate(15);
        return view($this->namespace.'::pages.articles.fo.grid',['articles'=>$articles]);
    }
    public function detail(Request $request, $slug){

        $article = Article::where('slug','=',$slug)->first();
        $article->translate();
        $category = Category::where('id','=',$article->category_id)->first();

        return view($this->namespace.'::pages.articles.fo.detail',['article'=>$article,'category'=>$category]);
    }

    public function list_by_category(Request $request, $category){
        $articles = DB::table('article')
            ->leftjoin('category','article.category_id','=','category.id')
            ->select('article.*','category.name as category_name')
            ->where('article.category_id','=',$category)
            ->paginate(15);
        return view($this->namespace.'::pages.articles.fo.grid',['articles'=>$articles]);
    }
}