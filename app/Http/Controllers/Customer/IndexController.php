<?php

namespace App\Http\Controllers\Customer;

class IndexController extends CommonController {

    public function index(){
        $title = '系统信息查看';
        return view('Customer.index', ['title' => $title]);
    }

}