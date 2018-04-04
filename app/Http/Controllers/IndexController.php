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
        echo '<pre>';
        //$users = DB::table('function')->select('id', 'fname')->get();
        /*$user = DB::table('function')
            ->where('id',13)
            ->select('id', 'fname')
            ->first();*/

        /*$fname = DB::table('function')
            ->whereRaw('id >= ? and candel = ?', [18, 1])
            ->pluck('fname', 'id');*/
        //dd($fname);

        /*echo '<pre>';
        DB::table('function')->orderBy('id')->chunk(2, function ($tion) {
            foreach ($tion as $key => $val) {
                if ($val->fname == '管理员管理') {
                    return false;
                }
                var_dump($val->fname);
            }
        });*/

        /*$bool = DB::table('function')->where('id', 12)->exists();
        var_dump($bool);*/

        /*$first = DB::table('function')->where('id', 12)->value('fname');
        var_dump($first);*/

        $query = DB::table('function')->select('fid','fname')->distinct()->get();
        $users = $query->addSelect('id')->get();
        var_dump($users);

    }

}