<?php

namespace Shura\Article\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends BaseController
{
    public $namespace = 'Article'; // registered in Service Provider
    public $content_type = 'article';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function validationError($message){
        $validate = (object)[
            'error'=>(object) ['status'=>'ERROR','message'=>$message],
            'data'=>$message
        ];
        return response()->json($validate);
    }
    function jsonResponse($data,$message=""){
        $response = (object)[
            'error'=>(object) ['status'=>'OK','message'=>$message],
            'data'=>$data
        ];
        return response()->json($response);
    }
}
