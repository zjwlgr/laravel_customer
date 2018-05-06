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
                    <label for="name" class="col-sm-2 control-label">公司名称</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" required value="{{ $one->name }}" name="infomation[name]" id="name" placeholder="公司名称">
                    </div>
                </div>

                <div class="form-group">
                    <label for="industry" class="col-sm-2 control-label">行业</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">{{ empty($one->industry) ? '未选择' : $customer_ar['industry'][$one->industry] }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['industry'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[industry]" id="industry" value="{{ $one->industry }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="PersonnelScale" class="col-sm-2 control-label">人员规模</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">{{ empty($one->PersonnelScale) ? '未选择' : $customer_ar['PersonnelScale'][$one->PersonnelScale] }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['PersonnelScale'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[PersonnelScale]" id="PersonnelScale" value="{{ $one->PersonnelScale }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Importance" class="col-sm-2 control-label">重要性</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">{{ empty($one->Importance) ? '未选择' : $customer_ar['Importance'][$one->Importance] }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['Importance'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[Importance]" id="Importance" value="{{ $one->Importance }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tctype" class="col-sm-2 control-label">类型</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">{{ empty($one->tctype) ? '未选择' : $customer_ar['tctype'][$one->tctype] }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['tctype'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[tctype]" id="tctype" value="{{ $one->tctype }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="opportunitys" class="col-sm-2 control-label">商机线索人</label>
                    <div class="col-sm-5">
                        <input type="text" value="{{ $one->opportunitys }}" class="form-control" required name="infomation[opportunitys]" id="opportunitys" placeholder="商机线索人">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-5">
                        <input type="text" value="{{ $one->phone }}" class="form-control" name="infomation[phone]" id="phone3" placeholder="手机号">
                    </div>
                    <div class="col-sm-3" style="padding-top: 7px;">
                        <span class="glyphicon glyphicon-ok" style="color: #009900; display: none"></span>
                        <span class="glyphicon glyphicon-remove" style="color: #FF0000; display: none"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qq" class="col-sm-2 control-label">QQ号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $one->qq }}" name="infomation[qq]" id="qq" placeholder="QQ号">
                    </div>
                </div>

                <div class="form-group">
                    <label for="weixin" class="col-sm-2 control-label">微信号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $one->weixin }}" name="infomation[weixin]" id="weixin" placeholder="微信号">
                    </div>
                </div>

                <div class="form-group">
                    <label for="statuss" class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">{{ empty($one->statuss) ? '未选择' : $customer_ar['statuss'][$one->statuss] }}</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['statuss'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[statuss]" id="statuss" value="{{ $one->statuss }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="describe" class="col-sm-2 control-label">状态描述</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="note" name="infomation[note]" rows="3" placeholder="状态描述">{{ $one->note }}</textarea>
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

