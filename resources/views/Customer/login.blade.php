@extends('layouts.base')

@section('title', 'Login')

@section('content')
    <style type="text/css">
        body{background: #5E87B0;}
    </style>
    <div class="container" style="margin-top: 50px;">

        <div class="login" style="padding-top: 20px;">

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>{{ session()->get('error') }}！</strong>
                </div>
            @endif

            <h3 class="form-title">{{ env('APP_NAME') }}入口<small>&nbsp;Login</small></h3>
            <form id="form1_login" name="form1_login" method="post" action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" name="ManagerInfo[username]" id="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" name="ManagerInfo[password]" id="password" placeholder="password">
                </div>
                <button type="submit" class="btn btn-primary" id="loading">
                    提&nbsp;交 <i class="glyphicon glyphicon-circle-arrow-right glyphicon_top_left"></i>
                </button>
            </form>
            <div class="create-account">
                <p>Copyright © 2016-{{ date('Y') }} by <a href="http://{{ $_SERVER['SERVER_NAME'] }}" target="_blank">{{ $_SERVER['SERVER_NAME'] }}</a><br /> All Rights Reserved. version zjwlgr.larv3.2</p>
            </div>
        </div>

    </div>
@endsection