@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">后台管理员管理</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">后台管理员修改</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/updateAdminUser" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">管理员名称：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                    @if ($errors->has('name'))
                                        <p style="color: red">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">原始密码：</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password" name="password">
                                    @if ($errors->has('password'))
                                        <p style="color: red">{{$errors->first('password')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">新密码：</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" >
                                    @if ($errors->has('newpassword'))
                                        <p style="color: red">{{$errors->first('newpassword')}}</p>
                                    @endif
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