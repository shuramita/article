<?php
namespace Shura\Article\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shura\Article\Controllers\Controller;
use Shura\Article\Models\Category;
use Validator;
class CategoryController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors()->all());
        }


        $category = Category::addNewCategory($request->all());


        return $this->jsonResponse($category);
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'required|numeric|min:1',
            'name'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors()->all());
        }
        $category = Category::updateCategory($request->all());

        return $this->jsonResponse($category,'article updated');
    }
    public function delete(Request $request,$id){
        $category = Category::find($id);
        if($category){

            $category->delete();
        }
        return $this->jsonResponse($category,'category deleted');
    }
}