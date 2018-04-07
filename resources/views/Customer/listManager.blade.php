@extends('layouts.main')
@section('admin_content')

    <div class="bs-example">

        <div class="bs-center">

            @include('common/message')

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="active">
                    <th width="5%">#</th>
                    <th width="10%">用户名</th>
                    <th width="9%">姓名</th>
                    <th width="11%">用户组</th>
                    <th width="6%">状态</th>
                    <th width="7%">登录次数</th>
                    <th width="10%">最后登录IP</th>
                    <th width="14%">最后登录时间</th>
                    <th width="9%">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($managers as $manager)
                <tr>
                    <th scope="row">{{ $manager->id }}</th>
                    <td>{{ $manager->username }}</td>
                    <td>{{ $manager->uname }}</td>
                    <td>{{ $userGroup[$manager->group_id] }}</td>
                    <td>
                        @if($manager->locking == 0)
                            <span class="text-success">正常</span>
                        @elseif($manager->locking == 1)
                            <span class="text-danger">锁定</span>
                        @endif
                    </td>
                    <td>{{ $manager->number }}</td>
                    <td>@if(empty($manager->login_ip))
                            0.0.0.0
                        @else
                            {{ $manager->login_ip }}
                        @endif</td>
                    <td>
                        @if(empty($manager->login_time))
                            0000-00-00 00:00:00
                        @else
                            {{ date('Y-m-d H:i:s', $manager->login_time) }}
                        @endif

                        <span style="cursor: pointer;"
                              class="glyphicon glyphicon-circle-arrow-right"
                              data-toggle="tooltip" data-placement="bottom"
                              title="录入时间：{{ date('Y-m-d H:i:s', $manager->created_at) }}">
                        </span>
                    </td>
                    <td>
                        <a href="{{ url('upManager-'.$manager->id.'.jay') }}">编辑</a> |
                        <a href="{{ url('delManager-'.$manager->id.'.jay') }}" class="delete" >删除</a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>

            {{ $managers->links() }}

        </div>


    </div>


@endsection