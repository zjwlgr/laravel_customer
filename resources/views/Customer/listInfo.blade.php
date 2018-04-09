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
                                <input type="text" style="width: 100px; border-color: #999;" class="form-control input-sm" name="infomation[imyear]" value="{{ $one['imyear'] }}" id="imyearn" placeholder="出生年">
                            </div>

                            <div class="form-group dropdown">
                                <select id="sexn" name="sex" class="search-select">
                                    <option value="">-性别-</option>
                                    @foreach($customer_ar['sex'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['sex']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="matrimonyn" name="matrimony" class="search-select">
                                    <option value="">-婚姻-</option>
                                    @foreach($customer_ar['matrimony'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['matrimony']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="bearn" name="bear" class="search-select">
                                    <option value="">-生育-</option>
                                    @foreach($customer_ar['bear'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['bear']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
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
                                <select id="developmentn" name="development" class="search-select">
                                    <option value="">-发展意愿-</option>
                                    @foreach($customer_ar['development'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['development']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown">
                                <select id="opportunityn" name="opportunity" class="search-select">
                                    <option value="">-商机类型-</option>
                                    @foreach($customer_ar['opportunity'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['opportunity']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="potentialn" name="potential" class="search-select">
                                    <option value="">-潜在商机-</option>
                                    @foreach($customer_ar['potential'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['potential']) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group dropdown" style="margin-top: 10px;">
                                <select id="contributionn" name="contribution" class="search-select">
                                    <option value="">-商机贡献-</option>
                                    @foreach($customer_ar['contribution'] as $key => $val)
                                        <option value="{{ $key }}" @if($key == $one['contribution']) selected @endif>{{ $val }}</option>
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
                                    <option value="3" @if(3 == $one['sort']) selected @endif>按最近一次见面时间升序</option>
                                    <option value="4" @if(4 == $one['sort']) selected @endif>按最近一次见面时间将序</option>
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
                    <th width="5%">#</th>
                    <th width="8%">姓名</th>
                    <th width="9%">手机号</th>
                    <th width="5%">性别</th>
                    <th width="6%">出生年</th>
                    <th width="5%">年龄</th>
                    <th width="6%">婚姻</th>
                    <th width="6%">生育</th>
                    <th width="12%">录入时间</th>
                    <th width="6%">录入人</th>
                    <th width="10%">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($infometions as $manager)
                    <tr>
                        <th scope="row">{{ $manager->id }}</th>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->phone }}</td>
                        <td>{{ $customer_ar['sex'][$manager->sex] }}</td>
                        <td>{{ $manager->imyear }}</td>
                        <td>{{ $manager->age }}</td>
                        <td>{{ $customer_ar['matrimony'][$manager->matrimony] }}</td>
                        <td>{{ $customer_ar['bear'][$manager->bear] }}</td>
                        <td>{{ date('Y-m-d H:i:s', $manager->created_at) }}</td>
                        <td>{{ $manager->admin_name }}</td>
                        <td>
                            <a href="{{ $manager->id }}" class="detail_model">详情</a> |
                            <a href="{{ url('upInfo-'.$manager->id.'.jay') }}">编辑</a> |
                            <a href="{{ url('delInfo-'.$manager->id.'.jay') }}" class="delete" >删除</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $infometions->appends([
            'name' => $one['name'],
            'phone' => $one['phone'],
            'imyear' => $one['imyear'],
            'sex' => $one['sex'],
            'matrimony' => $one['matrimony'],
            'bear' => $one['bear'],
            'industry' => $one['industry'],
            'development' => $one['development'],
            'opportunity' => $one['opportunity'],
            'potential' => $one['potential'],
            'contribution' => $one['contribution'],
            'tiveness' => $one['tiveness'],
            'admin_id' => $one['admin_id'],
            'sort' => $one['sort']
            ])->links() }}

        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">客户信息详情</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">

                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td style="text-align: right;" width="20%">姓名：</td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">手机号：</td>
                            <td id="phone"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">性别：</td>
                            <td id="sex"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">出生年：</td>
                            <td id="imyear"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">年龄：</td>
                            <td id="age"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">婚姻：</td>
                            <td id="matrimony"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">生育：</td>
                            <td id="bear"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">QQ号：</td>
                            <td id="qq"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">微信号：</td>
                            <td id="weixin"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">籍贯：</td>
                            <td id="origin"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">职位：</td>
                            <td id="position"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">目前任职公司：</td>
                            <td id="currently"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">行业：</td>
                            <td id="industry"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">发展意愿：</td>
                            <td id="development"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">最近一次见面：</td>
                            <td id="divided"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">商机类型：</td>
                            <td id="opportunity"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">成单分成比例：</td>
                            <td id="dividedd"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">潜在商机：</td>
                            <td id="potential"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">推荐职位：</td>
                            <td id="recommend"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">商机贡献：</td>
                            <td id="contribution"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">商机结果描述：</td>
                            <td id="describe"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">有效性：</td>
                            <td id="tiveness"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">备注：</td>
                            <td id="note"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">录入时间：</td>
                            <td id="create_at"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">录入人：</td>
                            <td id="admin_id"></td>
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