<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends CommonController
{
    protected $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Company();
    }

    public function addCompany(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $posts = $request->input('infomation');
            $posts['admin_id'] = $this->adminData['id'];
            if($this->model->create($posts))
            {
                return redirect('listCompany.jay')->with('success', '公司信息新增成功');
            } else {
                return redirect()->back();
            }
        } else {
            $customer_ar = config('myconfig.customer');
            $title = '公司信息新增';
            return view('Customer.addCompany', [
                'title' => $title,
                'customer_ar' => $customer_ar
            ]);
        }
    }

    public function listCompany(Request $request){
        $posts = $request->all();

        $where = [];
        if($posts['name'] !== null){
            $where[] = ['name', 'like', '%'.$posts['name'].'%'];
        }
        if($posts['industry'] !== null){
            $where[] = ['industry', '=', $posts['industry']];
        }
        if($posts['Importance'] !== null){
            $where[] = ['Importance', '=', $posts['Importance']];
        }
        if($posts['tctype'] !== null){
            $where[] = ['tctype', '=', $posts['tctype']];
        }
        if($posts['PersonnelScale'] !== null){
            $where[] = ['PersonnelScale', '=', $posts['PersonnelScale']];
        }
        if($posts['statuss'] !== null){
            $where[] = ['statuss', '=', $posts['statuss']];
        }

        if($this->adminData['group_id'] == 1) {
            if ($posts['admin_id'] !== null) {
                $where[] = ['admin_id', '=', $posts['admin_id']];
            }
        }else{
            $where[] = ['admin_id', '=', $this->adminData['id']];
        }


        $field = 'id'; $sort = 'desc';
        /*if($posts['sort'] !== null){
            if($posts['sort'] == 1){//按录入时间升序
                $field = 'id'; $sort = 'asc';
            }
            if($posts['sort'] == 2){//按录入时间将序
                $field = 'id'; $sort = 'desc';
            }
            if($posts['sort'] == 3){//按毕业时间升序
                $field = 'graduation'; $sort = 'asc';
            }
            if($posts['sort'] == 4){//按毕业时间将序
                $field = 'graduation'; $sort = 'desc';
            }
        }*/

        //$infometions = $this->model->where($where)->orderBy($field, $sort)->toSql();
        //dd($infometions);

        $infometions = $this->model->where($where)->orderBy($field, $sort)->paginate(20);

        foreach ($infometions as $key => $val){
            $admin = DB::table('manager')->select('uname')->find($val->admin_id);
            $infometions[$key]->admin_name = $admin->uname;
        }

        return view('Customer.listCompany', [
            'title' => '公司信息管理',
            'infometions' => $infometions,
            'customer_ar' => config('myconfig.customer'),
            'one' => $posts,
            'admins' => DB::table('manager')->select('id','uname')->get()
        ]);
    }

    public function upCompany(Request $request, $id){
        if($request->isMethod('POST')){
            if($this->model->find($id)->update($request->input('infomation'))){
                return redirect('listCompany.jay')->with('success', '公司信息编辑成功');
            }else{
                return redirect()->back();
            }
        }else{
            return view('Customer.upCompany', [
                'title' => '公司信息编辑',
                'one' => $this->model->find($id),
                'customer_ar' => config('myconfig.customer')
            ]);
        }
    }

    public function delCompany($id){
        $num = $this->model->destroy($id);
        if(!empty($num)){
            return redirect()->back()->with('success', '删除信息成功');
        }else{
            return redirect()->back()->with('error', '删除信息失败');
        }
    }

    /*public function ajaxPhone(Request $request){
        $phone = $request->input('phone');
        $isPhone = $this->model->where('phone', $phone)->first();
        if($isPhone !== null){
            return response()->json(['code' => 1, 'msg' => '手机号已存在！']);
        }else{
            return response()->json(['code' => 0, 'msg' => '手机号可用！']);
        }
    }

    //更新联系记录字段 ajax
    public function ajaxUpdateField(Request $request){
        $id = $request->input('id');
        $content = $request->input('content');
        $posts['updatefield'] = $content;
        echo $this->model->find($id)->update($posts);
        //echo $id.'--'.$content;
    }*/

    public function ajaxDetail(Request $request){
        $id = $request->input('id');
        $customer_ar = config('myconfig.customer');
        $nodes = DB::table('company')->where('id', $id)->get()->toArray();
        $arrays = $nodes[0];
        foreach ($arrays as $key => $val){
            if($val == null){
                $arrays->$key = '';
            }
        }
        $admin = DB::table('manager')->select('uname')->find($arrays->admin_id);
        $arrays->industry = $customer_ar['industry'][$arrays->industry];
        $arrays->PersonnelScale = $customer_ar['PersonnelScale'][$arrays->PersonnelScale];
        $arrays->Importance = $customer_ar['Importance'][$arrays->Importance];
        $arrays->tctype = $customer_ar['tctype'][$arrays->tctype];
        $arrays->statuss = $customer_ar['statuss'][$arrays->statuss];
        $arrays->created_at = date('Y-m-d H:i:s', $arrays->created_at);
        $arrays->note = $this->replace_y($arrays->note);
        $arrays->admin_id = $admin->uname;
        return response()->json($arrays);
    }

    //替换空格与回车
    public function replace_y($note){
        $note = str_replace(' ','&nbsp;',$note);
        $note = str_replace("\r\n","<br>",$note);
        $note = str_replace("\n\r","<br>",$note);
        $note = str_replace("\n","<br>",$note);
        $note = str_replace("\r","<br>",$note);
        return $note;
    }


}