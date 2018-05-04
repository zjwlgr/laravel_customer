@extends('layouts.main')
@section('admin_content')

    <div class="bs-example">

        <div class="bs-center" style="padding-top: 0px;">

            @include('common/message')

            <table class="table table-margin" style="margin-bottom: 0px;">

                <thead>
                <tr>
                    <td width="5%" class="text-muted">筛选</td>
                    <td width="95%">
                        <form class="form-inline" style="position: relative; bottom: 5px;">
                            <div class="form-group">
                                <input type="text" style="width: 100px; border-color: #999;" class="form-control input-sm" name="name" value="{{ $one['name'] }}" id="namen" placeholder="姓名">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" style="border-color: #999;" class="form-control input-sm" id="phonen" value="{{ $one['phone'] }}" placeholder="手机号">
                            </div>
                            <div class="form-group">
                                <input type="text" style="width: 100px; border-color: #999;" class="form-control input-sm" name="imyearmd" value="{{ $one['imyearmd'] }}" id="imyearmdn" placeholder="出生年">
                            </div>

                            <div class="form-group">
                                <input type="text" name="position" style="border-color: #999;" class="form-control input-sm" id="positionn" value="{{ $one['position'] }}" placeholder="职位">
                            </div>

                            <div class="form-group">
                                <input type="text" name="note" style="border-color: #999;" class="form-control input-sm" id="noten" value="{{ $one['note'] }}" placeholder="大文本框检索">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <input type="text" style="width: 70px; border-color: #999;" class="form-control input-sm" name="graduation_s" value="{{ $one['graduation_s'] }}" id="graduation_s" placeholder="工作年限">
                                    <div class="input-group-addon">至</div>
                                    <input type="text" style="width: 70px; border-color: #999;" class="form-control input-sm" name="graduation_e" value="{{ $one['graduation_e'] }}" id="graduation_e" placeholder="工作年限">
                                </div>
                            </div>
                            <div class="form-group" style="width: 40px;">
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="sexn" name="sex" class="search-select">
                                    <option value="">-性别-</option>
                                    @foreach($customer_ar['sex'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['sex']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="educationn" name="education" class="search-select">
                                    <option value="">-学历-</option>
                                    @foreach($customer_ar['education'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['education']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="industryn" name="industry" class="search-select">
                                    <option value="">-行业-</option>
                                    @foreach($customer_ar['industry'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['industry']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="tivenessn" name="tiveness" class="search-select">
                                    <option value="">-有效性-</option>
                                    @foreach($customer_ar['tiveness'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['tiveness']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>


                            @if(session()->get('adminData')['group_id'] == 1)
                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="admin_idn" name="admin_id" class="search-select">
                                    <option value="">-录入人-</option>
                                    @foreach($admins as $key => $val)
                                        <option value="{{ $val->id }}" @if($val->id == $one['admin_id']) selected @endif>{{ $val->uname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="sort" name="sort" class="search-select">
                                    <option value="">-排序-</option>
                                    <option value="1" @if(1 == $one['sort']) selected @endif>按录入时间升序</option>
                                    <option value="2" @if(2 == $one['sort']) selected @endif>按录入时间将序</option>
                                    <option value="3" @if(3 == $one['sort']) selected @endif>按毕业时间升序</option>
                                    <option value="4" @if(4 == $one['sort']) selected @endif>按毕业时间将序</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px;">点我搜索</button>
                        </form>
                    </td>
                </tr>
                </thead>

            </table>

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th width="5%" style="text-align: center;">序号</th>
                    <th width="7%" style="text-align: center;">姓名</th>
                    <th width="9%" style="text-align: center;">手机号</th>
                    <th width="5%" style="text-align: center;">性别</th>
                    <th width="9%" style="text-align: center;">出生日期</th>
                    <th width="5%" style="text-align: center;">年龄</th>
                    <th width="6%" style="text-align: center;">学历</th>
                    <th width="14%" style="text-align: center;">录入时间</th>
                    <th width="6%" style="text-align: center;">录入人</th>
                    <th width="10%" style="text-align: center;">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($infometions as $manager)
                    <tr>
                        <th style="text-align: center;">{{ $manager->id }}</th>
                        <td style="text-align: center;">{{ $manager->name }}</td>
                        <td style="text-align: center;">{{ $manager->phone }}</td>
                        <td style="text-align: center;">{{ $customer_ar['sex'][$manager->sex] }}</td>
                        <td style="text-align: center;">{{ $manager->imyearmd }}</td>
                        <td style="text-align: center;">{{ $manager->age }}</td>
                        <td style="text-align: center;">{{ $customer_ar['education'][$manager->education] }}</td>
                        <td style="text-align: center;">{{ date('Y-m-d H:i:s', $manager->created_at) }}</td>
                        <td style="text-align: center;">{{ $manager->admin_name }}</td>
                        <td style="text-align: center;">
                            <a href="{{ $manager->id }}" class="detail_model_resume">详情</a>

                            @if(session()->get('adminData')['id'] == $manager->admin_id || session()->get('adminData')['group_id'] == 1)|
                            <a href="{{ url('upResume-'.$manager->id.'.jay') }}">编辑</a>
                            @endif

                            @if(session()->get('adminData')['group_id'] == 1)|
                            <a href="{{ url('delResume-'.$manager->id.'.jay') }}" class="delete" >删除</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $infometions->appends([
            'name'         => $one['name'],
            'phone'        => $one['phone'],
            'imyearmd'     => $one['imyearmd'],
            'position'     => $one['position'],
            'sex'          => $one['sex'],
            'note'         => $one['note'],
            'education'    => $one['education'],
            'graduation_s' => $one['graduation_s'],
            'graduation_e' => $one['graduation_e'],
            'industry'     => $one['industry'],
            'tiveness'     => $one['tiveness'],
            'admin_id'     => $one['admin_id'],
            'sort'         => $one['sort']
            ])->links() }}

        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModal_resume" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">简历信息详情</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">

                    <input type="hidden" id="resume_id" value="">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td style="text-align: right;" width="15%">姓名：</td>
                            <td id="name" width="30%"></td>

                            <td style="text-align: right;" width="15%">手机号：</td>
                            <td id="phone"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">性别：</td>
                            <td id="sex"></td>

                            <td style="text-align: right;">出生日期：</td>
                            <td id="imyearmd"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">年龄：</td>
                            <td id="age"></td>

                            <td style="text-align: right;">QQ号：</td>
                            <td id="qq"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">微信号：</td>
                            <td id="weixin"></td>

                            <td style="text-align: right;">邮箱：</td>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">学历：</td>
                            <td id="education"></td>

                            <td style="text-align: right;">毕业时间：</td>
                            <td id="graduation"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">职位：</td>
                            <td id="position"></td>

                            <td style="text-align: right;">目前任职公司：</td>
                            <td id="currently"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">行业：</td>
                            <td id="industry"></td>

                            <td style="text-align: right;">有效性：</td>
                            <td id="tiveness"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">录入情况：</td>
                            <td>
                                <span id="admin_id">张健</span>&nbsp;&nbsp;
                                <span id="create_at">2018-05-01 20:00:35</span>
                            </td>

                            <td colspan="2" rowspan="2">
                                <textarea class="form-control" id="updatefield" name="updatefield" rows="3" placeholder="联系记录信息"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">其它信息：</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3" id="note">

                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>

@endsection