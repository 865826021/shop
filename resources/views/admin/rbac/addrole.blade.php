@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">添加角色</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">添加角色</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/addRoleStore" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">角色名称：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <p style="color: red">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">角色描述：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="remark" name="remark" value="{{old('remark')}}">
                                    @if ($errors->has('remark'))
                                        <p style="color: red">{{$errors->first('remark')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-6">
                                    {{--<select class="form-control" id="publish" name="status">--}}
                                        {{--<option selected value="0">开启</option>--}}
                                        {{--<option value="1">关闭</option>--}}
                                    {{--</select>--}}
                                    <input type="radio" id="status" name="status" value="0" checked="checked">&nbsp;开启&nbsp;
                                    <input type="radio" id="status" name="status" value="1">关闭
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