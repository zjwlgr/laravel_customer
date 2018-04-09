<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer\Manager;
use Illuminate\Http\Request;

class ManagerController extends CommonController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {

            $adminData = $this->adminData;
            if ($adminData['group_id'] != 1) {
                return redirect('login.jay');
            }

            return $next($request);
        });
    }

    public function addManager(Request $request){
        if($request->isMethod('POST')){
            $Manager = new Manager();
            $manager_ar = $request->input('ManagerInfo');
            $manager_ar['password'] = md5($manager_ar['password']);
            if($Manager->create($manager_ar)) {
                return redirect('listManager.jay')->with('success', '管理员新增成功');
            }else{
                return redirect()->back();
            }
        }else {
            $userGroup = Manager::userGroup();
            $title = '管理员新增';
            return view('Customer.addManager', [
                'title' => $title,
                'userGroup' => $userGroup
            ]);
        }
    }

    public function listManager(){
        $Manager = new Manager();
        $managers = $Manager->paginate(15);
        $userGroup = Manager::userGroup();
        $title = '管理员管理';
        return view('Customer.listManager', [
            'title' => $title,
            'managers' => $managers,
            'userGroup' => $userGroup
        ]);
    }

    public function upManager(Request $request, $id){
        $manager = Manager::find($id);
        if($request->isMethod('POST')){
            $manager_ar = $request->input('ManagerInfo');
            $manager->username = $manager_ar['username'];
            $manager->uname = $manager_ar['uname'];
            $manager->group_id = $manager_ar['group_id'];
            $manager->locking = $manager_ar['locking'];
            if(!empty($manager_ar['password'])){
                $manager->password = md5($manager_ar['password']);
            }
            if($manager->save()){
                return redirect('listManager.jay')->with('success', '管理员编辑成功');
            }else{
                return redirect()->back();
            }
        }else{
            $userGroup = Manager::userGroup();
            $title = '管理员编辑';
            return view('Customer.upManager', [
                'title' => $title,
                'userGroup' => $userGroup,
                'manager' => $manager
            ]);
        }
    }

    public function delManager($id){
        $num = Manager::destroy($id);
        if(!empty($num)){
            return redirect('listManager.jay')->with('success', '删除管理员成功');
        }else{
            return redirect('listManager.jay')->with('error', '删除管理员失败');
        }
    }



}