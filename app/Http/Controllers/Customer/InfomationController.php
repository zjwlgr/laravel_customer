<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer\Infomation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfomationController extends CommonController
{
    protected $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Infomation();
    }

    public function addInfo(Request $request){
        if($request->isMethod('POST')){

            $this->validate($request, [
                'infomation.name' => 'required',
                'infomation.phone' => 'required',
                'infomation.imyear' => 'required'
            ], [
                'required' => ':attribute为必填项',
            ], [
                'infomation.name' => '姓名',
                'infomation.phone' => '手机号',
                'infomation.imyear' => '出生年',
            ]);

            $posts = $request->input('infomation');

            $isPhone = $this->model->where('phone',$posts['phone'])->first();
            if($isPhone !== null){
                return redirect()->back()->with('error', '手机号已存在');
            }

            $posts['admin_id'] = $this->adminData['id'];
            if($this->model->create($posts)){
                return redirect('listInfo.jay')->with('success', '客户信息新增成功');
            }else{
                return redirect()->back();
            }

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
        $infometions = $this->model->paginate(15);
        $customer_ar = config('myconfig.customer');
        $title = '客户信息管理';
        return view('Customer.listInfo', [
            'title' => $title,
            'infometions' => $infometions,
            'customer_ar' => $customer_ar
        ]);
    }

    public function upInfo(Request $request, $id){
        if($request->isMethod('POST')){
            $posts = $request->input('infomation');
            if($this->model->find($id)->update($posts)){
                return redirect('listInfo.jay')->with('success', '客户信息编辑成功');
            }else{
                return redirect()->back();
            }
        }else{
            $one = $this->model->find($id);
            $customer_ar = config('myconfig.customer');
            return view('Customer.upInfo', [
                'title' => '客户信息编辑',
                'one' => $one,
                'customer_ar' => $customer_ar
            ]);
        }
    }

    public function delInfo($id){
        $num = $this->model->destroy($id);
        if(!empty($num)){
            return redirect()->back()->with('success', '删除信息成功');
        }else{
            return redirect()->back()->with('error', '删除信息失败');
        }
    }

    public function ajaxPhone(Request $request){
        $phone = $request->input('phone');
        $isPhone = $this->model->where('phone', $phone)->first();
        if($isPhone !== null){
            return response()->json(['code' => 1, 'msg' => '手机号已存在！']);
        }else{
            return response()->json(['code' => 0, 'msg' => '手机号可用！']);
        }
    }

    public function ajaxDetail(Request $request){
        $id = $request->input('id');
        $customer_ar = config('myconfig.customer');
        $nodes = DB::table('infometion')->where('id', $id)->get()->toArray();
        $arrays = $nodes[0];
        foreach ($arrays as $key => $val){
            if($val == null){
                $arrays->$key = '';
            }
        }
        $arrays->sex = $customer_ar['sex'][$arrays->sex];
        $arrays->matrimony = $customer_ar['matrimony'][$arrays->matrimony];
        $arrays->bear = $customer_ar['bear'][$arrays->bear];
        return response()->json($arrays);
    }


}