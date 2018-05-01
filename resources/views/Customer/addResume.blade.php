@extends('layouts.main')
@section('admin_content')

    <div class="bs-example">

        <div class="bs-center">

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>{{ session()->get('error') }}！</strong>
                </div>
            @endif

            @if(count($errors))
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <p>{{ $errors->first() }}</p>
            </div>
            @endif

            <form id="form1_resume" name="form1_resume" method="post" action="" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" required value="{{ old('infomation')['name'] }}" name="infomation[name]" id="name" placeholder="姓名">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" required name="infomation[phone]" id="phone2" placeholder="手机号">
                    </div>
                    <div class="col-sm-3" style="padding-top: 7px;">
                        <span class="glyphicon glyphicon-ok" style="color: #009900; display: none"></span>
                        <span class="glyphicon glyphicon-remove" style="color: #FF0000; display: none"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sex" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择性别-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['sex'] as $key => $val)
                                <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[sex]" id="sex" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imyearmd" class="col-sm-2 control-label">出生日期</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" readonly name="infomation[imyearmd]" id="imyearmd" placeholder="出生日期">
                    </div>
                </div>

                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control" name="infomation[age]" id="age" placeholder="年龄：根据选择的出生日期自动计算">
                    </div>
                </div>

                <div class="form-group">
                    <label for="qq" class="col-sm-2 control-label">QQ号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[qq]" id="qq" placeholder="QQ号">
                    </div>
                </div>

                <div class="form-group">
                    <label for="weixin" class="col-sm-2 control-label">微信号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[weixin]" id="weixin" placeholder="微信号">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="infomation[email]" id="email" placeholder="邮箱">
                    </div>
                </div>

                <div class="form-group">
                    <label for="education" class="col-sm-2 control-label">学历</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择学历-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['education'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[education]" id="education" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="graduation" class="col-sm-2 control-label">毕业时间</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" readonly name="infomation[graduation]" id="graduation" placeholder="毕业时间">
                    </div>
                </div>

                <div class="form-group">
                    <label for="position" class="col-sm-2 control-label">职位</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[position]" id="position" placeholder="职位">
                    </div>
                </div>

                <div class="form-group">
                    <label for="currently" class="col-sm-2 control-label">目前任职公司</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[currently]" id="currently" placeholder="目前任职公司">
                    </div>
                </div>

                <div class="form-group">
                    <label for="industry" class="col-sm-2 control-label">行业</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择行业-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['industry'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[industry]" id="industry" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tiveness" class="col-sm-2 control-label">有效性</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择有效性-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['tiveness'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[tiveness]" id="tiveness" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="describe" class="col-sm-2 control-label">其它信息</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="note" name="infomation[note]" rows="20" placeholder="复制进去整个简历文字信息"></textarea>
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

@section('otherjs')
    <script src="{{ asset('laydate/laydate.js') }}"></script>
@endsection
