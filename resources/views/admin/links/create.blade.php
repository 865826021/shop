@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">文章类别管理</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">友情链接添加</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/links/store" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">链接名称：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="link_name" name="link_name" placeholder="链接名称" value="{{old('link_name')}}">
                                    @if ($errors->has('link_name'))
                                        <p style="color: red">{{$errors->first('link_name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">网站标题：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="link_title" name="link_title" placeholder="网站标题" value="{{old('link_title')}}">
                                    @if ($errors->has('link_title'))
                                        <p style="color: red">{{$errors->first('link_title')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">链接url：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="link_url" name="link_url" placeholder="链接url">
                                    例：http://www.baidu.com
                                    @if ($errors->has('link_url'))
                                        <p style="color: red">{{$errors->first('link_url')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">排序：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="link_order" name="link_order" placeholder="排序" value="{{old('link_order')}}">
                                    @if ($errors->has('link_order'))
                                        <p style="color: red">{{$errors->first('link_order')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-info">添加</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->

        </div> <!-- End row -->

    </div>
@endsection