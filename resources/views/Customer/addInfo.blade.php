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

            <form id="form1_infomation" name="form1_infomation" method="post" action="" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ old('infomation')['name'] }}" name="infomation[name]" id="name" placeholder="姓名">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[phone]" id="phone" placeholder="手机号">
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
                    <label for="imyear" class="col-sm-2 control-label">出生年</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" readonly name="infomation[imyear]" id="imyear" placeholder="出生年">
                    </div>
                </div>

                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control" name="infomation[age]" id="age" placeholder="年龄：根据选择的出生年自动计算">
                    </div>
                </div>

                <div class="form-group">
                    <label for="matrimony" class="col-sm-2 control-label">婚姻</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择婚姻-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['matrimony'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[matrimony]" id="matrimony" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bear" class="col-sm-2 control-label">生育</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择生育-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['bear'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[bear]" id="bear" value="0" />
                        </div>
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
                    <label for="origin" class="col-sm-2 control-label">籍贯</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[origin]" id="origin" placeholder="籍贯">
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
                    <label for="development" class="col-sm-2 control-label">发展意愿</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择发展意愿-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['development'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[development]" id="development" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="divided" class="col-sm-2 control-label">最近一次见面</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" readonly name="infomation[divided]" id="divided" placeholder="最近一次见面时间">
                    </div>
                </div>

                <div class="form-group">
                    <label for="opportunity" class="col-sm-2 control-label">商机类型</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择商机类型-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['opportunity'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[opportunity]" id="opportunity" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dividedd" class="col-sm-2 control-label">成单分成比例</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[dividedd]" id="dividedd" placeholder="成单分成比例">
                    </div>
                </div>

                <div class="form-group">
                    <label for="potential" class="col-sm-2 control-label">潜在商机</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择潜在商机-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['potential'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[potential]" id="potential" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="recommend" class="col-sm-2 control-label">推荐职位</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="infomation[recommend]" id="recommend" placeholder="推荐职位">
                    </div>
                </div>

                <div class="form-group">
                    <label for="contribution" class="col-sm-2 control-label">商机贡献</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择商机贡献-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['contribution'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[contribution]" id="contribution" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="describe" class="col-sm-2 control-label">商机结果描述</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="describe" name="infomation[describe]" rows="3" placeholder="商机结果描述"></textarea>
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
                    <label for="enterprises" class="col-sm-2 control-label">企业规模</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择企业规模-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['enterprises'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[enterprises]" id="enterprises" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="importance" class="col-sm-2 control-label">重要性</label>
                    <div class="col-sm-5">
                        <div class="dropdown" style="float: left;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <span id="text">-选择重要性-</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                                @foreach($customer_ar['importance'] as $key => $val)
                                    <li role="presentation"><a href="#" _i="{{ $key }}">{{ $val }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="infomation[importance]" id="importance" value="0" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="describe" class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="note" name="infomation[note]" rows="3" placeholder="备注"></textarea>
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
