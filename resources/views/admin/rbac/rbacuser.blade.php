@extends('admin.layouts.default')
@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">管理员管理</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理员列表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>管理员名称</th>
                                            <th>用户角色</th>
                                            <th>状态</th>
                                            <th>上次登录时间</th>
                                            <th>上一次登录IP</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($UserList) && is_array($UserList))
                                            @foreach($UserList as $a)
                                            <tr>
                                                <td>{{ $a['id'] }}</td>
                                                <td>{{ $a['name'] }}</td>
                                                <td>{{ $a['role'] }}</td>
                                                @if($a['status']==1)
                                                    <td>未开启</td>
                                                    @else
                                                    <td>已开启</td>
                                                @endif
                                                <td>{{ date("Y-m-d H:i:s",$a['login_time']) }}</td>
                                                <td>{{ $a['login_ip'] }}</td>
                                                <td><button onclick="window.location='/updateUser/{{ $a['id'] }}'" class="btn btn-primary btn-xs">修改</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4"></div>
                </div>
            </div>
        </div> <!-- End row -->


    </div>
    @endsection