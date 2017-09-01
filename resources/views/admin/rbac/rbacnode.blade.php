@extends('admin.layouts.default')
@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">节点管理</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">节点列表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>节点名称</th>
                                            <th>节点描述</th>
                                            <th>状态</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($NodeList) && is_array($NodeList))
                                            @foreach($NodeList as $a)
                                            <tr>
                                                <td>{{ $a['id'] }}</td>
                                                <td>{{ $a['name'] }}</td>
                                                <td>{{ $a['title'] }}</td>
                                                @if($a['status']==1)
                                                    <td>未开启</td>
                                                    @else
                                                    <td>已开启</td>
                                                @endif
                                                {{--<td><button onclick="window.location='/roleEdit/{{ $a['id'] }}'" class="btn btn-primary btn-xs">修改</button> &nbsp; &nbsp;--}}
                                                    {{--<button onclick="window.location='{{url('/roleDestroy')}}/{{$a['id']}}'" class="btn btn-danger btn-xs del">删除</button>--}}
                                                {{--</td>--}}
                                                <td>{{ $a['sort'] }}</td>
                                                <td><button onclick="window.location='/updateNode/{{ $a['id'] }}'" class="btn btn-primary btn-xs">修改</button>
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