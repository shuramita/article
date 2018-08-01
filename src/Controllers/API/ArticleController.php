<?php

namespace Shuramita\Article\Controllers\API;

//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Shuramita\Article\Controllers\Controller;
use Shuramita\Article\Models\Article;
use Validator;
class ArticleController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'category_id'=>'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors()->all());
        }


        $article = Article::addNewArticle($request->all());
        // build product_attr array

        return $this->jsonResponse($article);
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'required|numeric|min:1',
            'title'=>'required',
            'category_id'=>'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors()->all());
        }
        $article = Article::find($request->get('id'));
        $article->title = $request->get('title');
        $article->slug = str_slug($article->title);
        $article->description = $request->get('description');
        $article->category_id = $request->get('category_id');
        $article->photos = $request->get('photos');
        $article->body = $request->get('body');
        $article->save();
        return $this->jsonResponse($article,'article updated');
    }
    public function delete(Request $request,$id){
        $article = Article::find($id);
        if($article){
            $photos = [];
            if(!empty($article->photos)){
                foreach (json_decode($article->photos) as $photo){
                    $photos[] = $photo->origin->uri;
                    $photos[] = $photo->small->uri;
                    $photos[] = $photo->medium->uri;
                    $photos[] = $photo->large->uri;
                }
            }
            $article->delete();
        }
        return $this->jsonResponse($article,'article deleted');
    }
}
