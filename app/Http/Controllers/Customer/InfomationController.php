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

    public function listInfo(Request $request){
        $posts = $request->all();

        $where = [];
        if($posts['name'] !== null){
            $where[] = ['name', 'like', '%'.$posts['name'].'%'];
        }
        if($posts['phone'] !== null){
            $where[] = ['phone', 'like', '%'.$posts['phone'].'%'];
        }
        if($posts['imyear'] !== null){
            $where[] = ['imyear', 'like', '%'.$posts['imyear'].'%'];
        }
        if($posts['recommend'] !== null){
            $where[] = ['recommend', 'like', '%'.$posts['recommend'].'%'];
        }
        if($posts['sex'] !== null){
            $where[] = ['sex', '=', $posts['sex']];
        }
        if($posts['matrimony'] !== null){
            $where[] = ['matrimony', '=', $posts['matrimony']];
        }
        if($posts['bear'] !== null){
            $where[] = ['bear', '=', $posts['bear']];
        }
        if($posts['industry'] !== null){
            $where[] = ['industry', '=', $posts['industry']];
        }
        if($posts['development'] !== null){
            $where[] = ['development', '=', $posts['development']];
        }
        if($posts['opportunity'] !== null){
            $where[] = ['opportunity', '=', $posts['opportunity']];
        }
        if($posts['potential'] !== null){
            $where[] = ['potential', '=', $posts['potential']];
        }
        if($posts['contribution'] !== null){
            $where[] = ['contribution', '=', $posts['contribution']];
        }
        if($posts['tiveness'] !== null){
            $where[] = ['tiveness', '=', $posts['tiveness']];
        }
        if($posts['enterprises'] !== null){
            $where[] = ['enterprises', '=', $posts['enterprises']];
        }
        if($posts['importance'] !== null){
            $where[] = ['importance', '=', $posts['importance']];
        }

        if($this->adminData['group_id'] == 1) {
            if ($posts['admin_id'] !== null) {
                $where[] = ['admin_id', '=', $posts['admin_id']];
            }
        }else{
            $where[] = ['admin_id', '=', $this->adminData['id']];
        }


        $field = 'id'; $sort = 'asc';
        if($posts['sort'] !== null){
            if($posts['sort'] == 1){//按录入时间升序
                $field = 'id'; $sort = 'asc';
            }
            if($posts['sort'] == 2){//按录入时间将序
                $field = 'id'; $sort = 'desc';
            }
            if($posts['sort'] == 3){//按最近一次见面时间升序
                $field = 'divided'; $sort = 'asc';
            }
            if($posts['sort'] == 4){//按最近一次见面时间将序
                $field = 'divided'; $sort = 'desc';
            }
        }

        //$infometions = $this->model->where($where)->orderBy($field, $sort)->toSql();
        //dd($infometions);

        $infometions = $this->model->where($where)->orderBy($field, $sort)->paginate(20);

        foreach ($infometions as $key => $val){
            $admin = DB::table('manager')->select('uname')->find($val->admin_id);
            $infometions[$key]->admin_name = $admin->uname;
        }
        $customer_ar = config('myconfig.customer');

        $admins = DB::table('manager')->select('id','uname')->get();

        $title = '客户信息管理';
        return view('Customer.listInfo', [
            'title' => $title,
            'infometions' => $infometions,
            'customer_ar' => $customer_ar,
            'one' => $posts,
            'admins' => $admins
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
        $admin = DB::table('manager')->select('uname')->find($arrays->admin_id);
        $arrays->sex = $customer_ar['sex'][$arrays->sex];
        $arrays->matrimony = $customer_ar['matrimony'][$arrays->matrimony];
        $arrays->bear = $customer_ar['bear'][$arrays->bear];
        $arrays->industry = $customer_ar['industry'][$arrays->industry];
        $arrays->development = $customer_ar['development'][$arrays->development];
        $arrays->opportunity = $customer_ar['opportunity'][$arrays->opportunity];
        $arrays->potential = $customer_ar['potential'][$arrays->potential];
        $arrays->contribution = $customer_ar['contribution'][$arrays->contribution];
        $arrays->tiveness = $customer_ar['tiveness'][$arrays->tiveness];
        $arrays->enterprises = $customer_ar['enterprises'][$arrays->enterprises];
        $arrays->importance = $customer_ar['importance'][$arrays->importance];
        $arrays->created_at = date('Y-m-d H:i:s', $arrays->created_at);
        $arrays->admin_id = $admin->uname;
        return response()->json($arrays);
    }


}