@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">个人用户管理</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">个人用户修改</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/user/update" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">用户名：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="user_name" readonly name="user_name" value="{{ $data['user_name'] }}">
                                    @if ($errors->has('user_name'))
                                        <p style="color: red">{{$errors->first('user_name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">密码：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="user_pwd" name="user_pwd" value="{{ $data['user_pwd'] }}">
                                    @if ($errors->has('user_pwd'))
                                        <p style="color: red">{{$errors->first('user_pwd')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">手机号：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{ $data['user_phone'] }}">
                                    @if ($errors->has('user_phone'))
                                        <p style="color: red">{{$errors->first('user_phone')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">邮箱：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="user_email" name="user_email" value="{{ $data['user_email'] }}">
                                    @if ($errors->has('user_email'))
                                        <p style="color: red">{{$errors->first('user_email')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="publish" name="publish">
                                        @if($data['publish']==0)
                                            <option selected value="0">已审核</option>
                                            <option value="1">未审核</option>
                                            @else
                                            <option value="0">已审核</option>
                                            <option selected value="1">未审核</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-info">修改</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->

        </div> <!-- End row -->

    </div>
@endsection