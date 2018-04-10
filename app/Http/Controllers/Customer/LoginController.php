<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Manager;

class LoginController extends Controller{

    public function login(Request $request){

        if($request->isMethod('POST')){
            $rE = $request['ManagerInfo'];

            $first = DB::table('manager')->select(['id', 'username', 'uname', 'group_id', 'locking', 'number'])
                ->where([
                ['username' ,'=', $rE['username']],
                ['password', '=', md5($rE['password'])]
            ])->first();

            if(!$first){
                return redirect('login.jay')->with('error', '用户名或密码不正确');
            }

            if($first->locking == 1){
                return redirect('login.jay')->with('error', '该用户已被锁定，无法登录！');
            }

            DB::table('manager')->where('id', $first->id)->increment('number');

            $Manager_M = new Manager();
            $update = $Manager_M->find($first->id);
            $update->login_ip = $request->getClientIp();
            $update->login_time = time();
            $update->save();

            $request->session()->put('adminData', [
                'id' => $first->id,
                'uname' => $first->uname,
                'group_id' => $first->group_id,
                'group_name' => $Manager_M->userGroup($first->group_id)
            ]);

            if($first->group_id == 1){
                return redirect('index.jay');
            }else{
                return redirect('addInfo.jay');
            }

        }else {
            return view('Customer.login');
        }
    }

    public function loginout(Request $request){
        $request->session()->forget('adminData');
        return redirect('login.jay');
    }


}