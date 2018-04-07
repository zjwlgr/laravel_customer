<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

class InfomationController extends CommonController
{
    public function addInfo(Request $request){
        if($request->isMethod('POST')){

            $this->validate($request, [
                //'infomation.name' => 'required|min:2|max:5'
                'infomation.name' => 'required',
                'infomation.phone' => 'required',
                'infomation.imyear' => 'required'
            ], [
                'required' => ':attribute为必填项',
                //'min' => '请填写真实的:attribute',
                //'max' => '请填写真实的:attribute'
            ], [
                'infomation.name' => '姓名',
                'infomation.phone' => '手机号',
                'infomation.imyear' => '出生年',
            ]);

            dd($request->input('infomation'));

        }else {
            $customer_ar = config('myconfig.customer');
            $title = '客户信息新增';
            return view('Customer.addInfo', [
                'title' => $title,
                'customer_ar' => $customer_ar
            ]);
        }
    }

    public function listInfo(){
        $title = '客户信息管理';
        return view('Customer.listInfo', ['title' => $title]);
    }



}