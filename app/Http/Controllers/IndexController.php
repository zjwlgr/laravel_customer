<?php

namespace App\Http\Controllers;

use App\Index;

class IndexController extends Controller {

    public function index(){
        $route = route('index');
        $model = Index::testset();
        return view('Index/index',[
            'url' => $route,
            'model' => $model
        ]);
    }

}