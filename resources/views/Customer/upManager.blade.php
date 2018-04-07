@extends('layouts.main')
@section('admin_content')

    <div class="bs-example">

        <div class="bs-center">

            <form id="form1_manager" name="form1_manager" method="post" action="" class="form-horizontal">
                <input type="hidden" id="id" name="ManagerInfo[id]" value="{{ $manager->id }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">用户组</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">
                                    @foreach($userGroup as $key =>$item)
                                        @if($key == $manager->group_id) {{ $item }} @endif
                                    @endforeach
                                </span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($userGroup as $key =>$item)
                                <li role="presentation"><a href="#" _i="{{ $key }}">{{ $item }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="ManagerInfo[group_id]" id="group_id" value="{{ $manager->group_id }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $manager->username }}" name="ManagerInfo[username]" id="username" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="ManagerInfo[password]" id="password" placeholder="注：密码不做修改请保持为空">
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="ManagerInfo[repassword]" id="repassword" placeholder="确认密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="uname" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $manager->uname }}" name="ManagerInfo[uname]" id="uname" placeholder="姓名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="ManagerInfo[locking]" @if($manager->locking == 0) checked @endif
                                        value="0"> 正常 &nbsp;
                            </label>
                            <label>
                                <input type="radio" name="ManagerInfo[locking]" @if($manager->locking == 1) checked @endif value="1"> 锁定
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"> 提 交 &nbsp;<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection