@extends('admin.layouts.default')
@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">友情链接管理</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">友情链接列表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>link_id</th>
                                            <th>链接名称</th>
                                            <th>网站标题</th>
                                            <th>链接url</th>
                                            <th>添加时间</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($LinksList) && isset($LinksList))
                                            @foreach($LinksList as $l)
                                                <tr>
                                                    <td>{{$l->link_id}}</td>
                                                    <td>{{$l->link_name}}</td>
                                                    <td>{{$l->link_title}}</td>
                                                    <td>{{$l->link_url}}</td>
                                                    <td>{{ date("Y-m-d h:i:s",$l->add_time) }}</td>
                                                    <td>{{$l->link_order}}</td>
                                                    <td><button onclick="window.location='/links/edit/{{ $l->link_id }}'" class="btn btn-primary btn-xs">修改</button> &nbsp; &nbsp;
                                                        <button onclick="window.location='{{url('/links/destroy')}}/{{$l->link_id}}'" class="btn btn-danger btn-xs del">删除</button>
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
                    <div class="col-xs-4 col-xs-offset-4">{!! $pageView !!}</div>
                </div>
            </div>
        </div> <!-- End row -->



    </div>
    @endsection