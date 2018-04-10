@extends('layouts.base')

@section('title', $title)

@section('content')
    <header id="header" class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="glyphicon glyphicon-chevron-left glyphicon-pos"></span>
                {{ env('APP_NAME') }}            <span class="glyphicon glyphicon-chevron-right glyphicon-pos"></span>
            </div>
            <ul id="navbar-left" class="nav navbar-nav pull-left">
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li id="header-user" class="dropdown">
                    <a class="dropdown-toggle" href="">
                        <span class="glyphicon glyphicon-user glyphicon-pos-2"></span>
                        {{ session()->get('adminData')['group_name'] }} [ <span class="username">{{ session()->get('adminData')['uname'] }}</span> ]
                    </a>
                </li>
                <li id="header-tasks" class="dropdown">
                    <a class="dropdown-toggle" href="{{ url('loginout.jay') }}">
                        <span class="glyphicon glyphicon-remove-circle glyphicon-pos-2"></span>
                        安全退出
                    </a>
                </li>
            </ul>
        </div>
    </header>


    <section id="page">

        <div class="sidebar" id="sidebar">
            <div class="sidebar-menu">

                <ul id="left_ajax">

                    <li class="has-sub">
                        <a href="javascript:void(0);" class="offsite" id="has_12">
                            <i class="glyphicon glyphicon-th-large"></i>
                            <span class="menu-text">系统功能管理</span>
                            <span class="glyphicon glyphicon-triangle-left arrow"></span>
                        </a>
                        <ul class="sub">
                            @if(session()->get('adminData')['group_id'] == 1)
                            <li><a href="{{ route('index') }}">系统信息查看</a></li>
                            <li><a href="{{ route('addManager') }}">管理员新增</a></li>
                            <li><a href="{{ route('listManager') }}">管理员管理</a></li>
                            @endif
                            <li><a href="{{ route('addInfo') }}">客户信息新增</a></li>
                            <li><a href="{{ route('listInfo') }}">客户信息管理</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="divide-20"></div>
            </div>
        </div>

        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div id="content" class="col-lg-12">

                        <div class="row_hander">
                            <ol class="breadcrumb backbread">
                                <span class="glyphicon glyphicon-log-out myglyphicon"></span>
                                <li class="active">{{ env('APP_NAME') }}</li>
                                <li class="active">{{ $title }}</li>
                            </ol>
                        </div>

                        <div class="row_main-content">

                            @yield('admin_content')

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>


    <footer class="bs-footer">
        Copyright © 2016-{{ date('Y') }} by <a href="http://{{ $_SERVER['SERVER_NAME'] }}" target="_blank">http://{{ $_SERVER['SERVER_NAME'] }}</a>  All Rights Reserved. version zjwlgr.larv3.2</footer>
@endsection