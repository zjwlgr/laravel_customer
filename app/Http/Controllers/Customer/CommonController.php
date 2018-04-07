<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public $adminData;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->adminData = $request->session()->get('adminData');

            if (!$request->session()->has('adminData')) {
                return redirect('login.jay');
            }

            return $next($request);
        });


    }
}