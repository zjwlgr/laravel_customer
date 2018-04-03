<?php

namespace App\Http\Controllers;

use App\Index;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

    public function index(){

        $route = route('index');
        $model = Index::testset();
        return view('Index/index',[
            'url' => $route,
            'model' => $model
        ]);
    }

    public function facade1(){
        $users = DB::table('function')->select('id', 'fname')->get();
        dd($users);
    }

}