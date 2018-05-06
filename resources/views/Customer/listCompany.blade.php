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
                                <input type="text" style="width: 140px; border-color: #999;" class="form-control input-sm" name="name" value="{{ $one['name'] }}" id="namen" placeholder="公司名称">
                            </div>

                            <div class="form-group dropdown">
                                <select id="industryn" name="industry" class="search-select">
                                    <option value="">-行业-</option>
                                    @foreach($customer_ar['industry'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['industry']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="Importancen" name="Importance" class="search-select">
                                    <option value="">-重要性-</option>
                                    @foreach($customer_ar['Importance'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['Importance']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="tctypen" name="tctype" class="search-select">
                                    <option value="">-类型-</option>
                                    @foreach($customer_ar['tctype'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['tctype']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="PersonnelScalen" name="PersonnelScale" class="search-select">
                                    <option value="">-人员规模-</option>
                                    @foreach($customer_ar['PersonnelScale'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['PersonnelScale']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="statussn" name="statuss" class="search-select">
                                    <option value="">-状态-</option>
                                    @foreach($customer_ar['statuss'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['statuss']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>


                            @if(session()->get('adminData')['group_id'] == 1)
                            <div class="form-group dropdown">
                                <select id="admin_idn" name="admin_id" class="search-select">
                                    <option value="">-录入人-</option>
                                    @foreach($admins as $key => $val)
                                        <option value="{{ $val->id }}" @if($val->id == $one['admin_id']) selected @endif>{{ $val->uname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            {{--<div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="sort" name="sort" class="search-select">
                                    <option value="">-排序-</option>
                                    <option value="1" @if(1 == $one['sort']) selected @endif>按录入时间升序</option>
                                    <option value="2" @if(2 == $one['sort']) selected @endif>按录入时间将序</option>
                                    <option value="3" @if(3 == $one['sort']) selected @endif>按毕业时间升序</option>
                                    <option value="4" @if(4 == $one['sort']) selected @endif>按毕业时间将序</option>
                                </select>
                            </div>--}}

                            <button type="submit" class="btn btn-primary btn-sm">点我搜索</button>
                        </form>
                    </td>
                </tr>
                </thead>

            </table>

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th width="5%" style="text-align: center;">序号</th>
                    <th width="17%" style="text-align: center;">公司名称</th>
                    <th width="9%" style="text-align: center;">行业</th>
                    {{--<th width="7%" style="text-align: center;">人员规模</th>--}}
                    <th width="9%" style="text-align: center;">重要性</th>
                    <th width="5%" style="text-align: center;">类型</th>
                    <th width="6%" style="text-align: center;">手机号</th>
                    <th width="12%" style="text-align: center;">录入时间</th>
                    <th width="6%" style="text-align: center;">录入人</th>
                    <th width="10%" style="text-align: center;">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($infometions as $manager)
                    <tr>
                        <th style="text-align: center;">{{ $manager->id }}</th>
                        <td style="text-align: center;">{{ $manager->name }}</td>
                        <td style="text-align: center;">{{ $customer_ar['industry'][$manager->industry] }}</td>
                        {{--<td style="text-align: center;">{{ $customer_ar['PersonnelScale'][$manager->PersonnelScale] }}</td>--}}
                        <td style="text-align: center;">{{ $customer_ar['Importance'][$manager->Importance] }}</td>
                        <td style="text-align: center;">{{ $customer_ar['tctype'][$manager->tctype] }}</td>
                        <td style="text-align: center;">{{ $manager->phone }}</td>
                        <td style="text-align: center;">{{ date('Y-m-d H:i:s', $manager->created_at) }}</td>
                        <td style="text-align: center;">{{ $manager->admin_name }}</td>
                        <td style="text-align: center;">
                            <a href="{{ $manager->id }}" class="detail_model_company">详情</a>

                            |
                            <a href="{{ url('upCompany-'.$manager->id.'.jay') }}">编辑</a>

                            @if(session()->get('adminData')['group_id'] == 1)|
                            <a href="{{ url('delCompany-'.$manager->id.'.jay') }}" class="delete" >删除</a>
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
            'currently'     => $one['currently'],
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
    <div class="modal fade bs-example-modal-lg" id="myModal_company" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">公司信息详情</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">

                    <input type="hidden" id="resume_id" value="">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td style="text-align: right;" width="15%">公司名称：</td>
                            <td id="name" width="30%"></td>

                            <td style="text-align: right;" width="15%">行业：</td>
                            <td id="industry"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">人员规模：</td>
                            <td id="PersonnelScale"></td>

                            <td style="text-align: right;">重要性：</td>
                            <td id="Importance"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">类型：</td>
                            <td id="tctype"></td>

                            <td style="text-align: right;">商机线索人：</td>
                            <td id="opportunitys"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">手机号：</td>
                            <td id="phone"></td>

                            <td style="text-align: right;">QQ号：</td>
                            <td id="qq"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">微信号：</td>
                            <td id="weixin"></td>

                            <td style="text-align: right;">状态：</td>
                            <td id="statuss"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">录入人：</td>
                            <td id="admin_id"></td>

                            <td style="text-align: right;">录入时间：</td>
                            <td id="create_at">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">状态描述：</td>
                            <td id="note" colspan="3"></td>
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