@extends('admin.layouts.default')
@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">类别管理</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">类别列表</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>标题</th>
											<th>图片</th>
                                            <th>发布时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($ArticleList as $v)
                                        <tr>
                                            <td>{{$v->cid}}</td>
                                            <td>{{$v->name}}</td>
                                            <td><img width="100px" height="50px" src="/{{$v->img}}"></td>
                                            <td>{{ date("Y-m-d h:i:s", $v->add_time) }}</td>
                                            <td><button onclick="window.location='/category/edit/{{ $v->cid }}'" class="btn btn-primary btn-xs">修改</button> &nbsp; &nbsp;
                                                <button onclick="window.location='{{url('/category/destroy')}}/{{$v->cid}}'" class="btn btn-danger btn-xs del">删除</button>
                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-4">{!! $pageView !!}</div>
                    </div>
                </div>
            </div>
        </div> <!-- End row -->



    </div>
    @endsection