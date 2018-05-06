<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumeController extends CommonController
{
    protected $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Resume();
    }

    public function addResume(Request $request){
        if($request->isMethod('POST')){

            $posts = $request->input('infomation');

            $isPhone = $this->model->where('phone',$posts['phone'])->first();
            if($isPhone !== null){
                return redirect()->back()->with('error', '手机号已存在');
            }

            $posts['admin_id'] = $this->adminData['id'];
            if($posts['graduation'] !== null) {
                $posts['jobyear'] = date('Y') - date('Y', strtotime($posts['graduation']));
            }
            if($this->model->create($posts)){
                return redirect('listResume.jay')->with('success', '简历信息新增成功');
            }else{
                return redirect()->back();
            }

        }else {

            $customer_ar = config('myconfig.customer');
            $title = '简历信息新增';
            return view('Customer.addResume', [
                'title' => $title,
                'customer_ar' => $customer_ar
            ]);

        }
    }

    public function listResume(Request $request){
        $posts = $request->all();

        $where = [];
        if($posts['name'] !== null){
            $where[] = ['name', 'like', '%'.$posts['name'].'%'];
        }
        if($posts['phone'] !== null){
            $where[] = ['phone', 'like', '%'.$posts['phone'].'%'];
        }
        if($posts['imyearmd'] !== null){
            $where[] = ['imyearmd', 'like', '%'.$posts['imyearmd'].'%'];
        }
        if($posts['position'] !== null){
            $where[] = ['position', 'like', '%'.$posts['position'].'%'];
        }
        if($posts['currently'] !== null){
            $where[] = ['currently', 'like', '%'.$posts['currently'].'%'];
        }
        if($posts['sex'] !== null){
            $where[] = ['sex', '=', $posts['sex']];
        }
        if($posts['note'] !== null){
            $where[] = ['note', 'like', '%'.$posts['note'].'%'];
        }
        if($posts['education'] !== null){
            $where[] = ['education', '=', $posts['education']];
        }
        if($posts['industry'] !== null){
            $where[] = ['industry', '=', $posts['industry']];
        }
        if($posts['tiveness'] !== null){
            $where[] = ['tiveness', '=', $posts['tiveness']];
        }

        if ($posts['admin_id'] !== null) {
            $where[] = ['admin_id', '=', $posts['admin_id']];
        }

        if ($posts['graduation_s'] !== null && $posts['graduation_e'] !== null) {
            $where[] = ['jobyear', '>=', $posts['graduation_s']];
            $where[] = ['jobyear', '<=', $posts['graduation_e']];
        }

        if ($posts['graduation_s'] !== null && $posts['graduation_e'] == null) {
            $where[] = ['jobyear', '>=', $posts['graduation_s']];
        }

        if ($posts['graduation_s'] == null && $posts['graduation_e'] !== null) {
            $where[] = ['jobyear', '<=', $posts['graduation_e']];
        }


        $field = 'id'; $sort = 'desc';
        if($posts['sort'] !== null){
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
        }

        //$infometions = $this->model->where($where)->orderBy($field, $sort)->toSql();
        //dd($infometions);

        $infometions = $this->model->where($where)->orderBy($field, $sort)->paginate(20);

        foreach ($infometions as $key => $val){
            $admin = DB::table('manager')->select('uname')->find($val->admin_id);
            $infometions[$key]->admin_name = $admin->uname;
            if($this->adminData['group_id'] == 1 || $this->adminData['id'] == $val->admin_id) {
                $phone = $val->phone;
                $email = $val->email;
            }else{
                $phone = '***********';
                $email = '*****@***.***';
            }
            $infometions[$key]->phone = $phone;
            $infometions[$key]->email = $email;
        }
        $customer_ar = config('myconfig.customer');

        $admins = DB::table('manager')->select('id','uname')->get();

        $title = '简历信息管理';
        return view('Customer.listResume', [
            'title' => $title,
            'infometions' => $infometions,
            'customer_ar' => $customer_ar,
            'one' => $posts,
            'admins' => $admins
        ]);
    }

    public function upResume(Request $request, $id){
        if($request->isMethod('POST')){
            $posts = $request->input('infomation');
            if($posts['graduation'] !== null) {
                $posts['jobyear'] = date('Y') - date('Y', strtotime($posts['graduation']));
            }
            if($this->model->find($id)->update($posts)){
                return redirect('listResume.jay')->with('success', '简历信息编辑成功');
            }else{
                return redirect()->back();
            }
        }else{
            $one = $this->model->find($id);
            $customer_ar = config('myconfig.customer');
            return view('Customer.upResume', [
                'title' => '简历信息编辑',
                'one' => $one,
                'customer_ar' => $customer_ar
            ]);
        }
    }

    public function delResume($id){
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

    //更新联系记录字段 ajax
    public function ajaxUpdateField(Request $request){
        $id = $request->input('id');
        $content = $request->input('content');
        $posts['updatefield'] = $content;
        echo $this->model->find($id)->update($posts);
        //echo $id.'--'.$content;
    }

    public function ajaxDetail(Request $request){
        $id = $request->input('id');
        $customer_ar = config('myconfig.customer');
        $nodes = DB::table('resume')->where('id', $id)->get()->toArray();
        $arrays = $nodes[0];
        foreach ($arrays as $key => $val){
            if($val == null){
                $arrays->$key = '';
            }
        }
        if($this->adminData['group_id'] == 1 || $this->adminData['id'] == $arrays->admin_id) {
            $phone = $arrays->phone;
            $email = $arrays->email;
        }else{
            $phone = '***********';
            $email = '*****@***.***';
        }
        $admin = DB::table('manager')->select('uname')->find($arrays->admin_id);
        $arrays->phone = $phone;
        $arrays->email = $email;
        $arrays->sex = $customer_ar['sex'][$arrays->sex];
        $arrays->education = $customer_ar['education'][$arrays->education];
        $arrays->industry = $customer_ar['industry'][$arrays->industry];
        $arrays->tiveness = $customer_ar['tiveness'][$arrays->tiveness];
        $arrays->created_at = date('Y-m-d H:i:s', $arrays->created_at);
        $arrays->admin_id = $admin->uname;
        $arrays->note = $this->replace_y($arrays->note);
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