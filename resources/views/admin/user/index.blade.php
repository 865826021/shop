@extends('admin.layouts.default')
@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">用户管理</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">用户列表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>用户名</th>
                                            <th>手机号</th>
                                            <th>邮箱</th>
                                            <th>注册时间</th>
                                            <th>审核状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($UserList as $a)
                                        <tr>
                                            <td>{{ $a['user_id'] }}</td>
                                            <td>{{ $a['user_name'] }}</td>
                                            <td>{{ $a['user_phone'] }}</td>
                                            <td>{{ $a['user_email'] }}</td>
                                            <td>{{ date("Y-m-d h:i:s", $a['reg_time']) }}</td>
                                            @if($a['publish']==1)
                                                <td>未审核</td>
                                                @else
                                                <td>已审核</td>
                                            @endif
                                            <td><button onclick="window.location='/user/edit/{{ $a['user_id'] }}'" class="btn btn-primary btn-xs">修改</button> &nbsp; &nbsp;
                                                <button onclick="window.location='{{url('/user/destroy')}}/{{$a['user_id']}}'" class="btn btn-danger btn-xs del">删除</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4">{!! $pageView !!}</div>
                </div>
            </div>
        </div> <!-- End row -->



    </div>
    @endsection