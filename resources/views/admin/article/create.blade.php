@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    @include('UEditor::head')

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">文章管理</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">文章添加</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/article/store" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">文章标题：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="art_title" name="art_title" placeholder="文章标题" value="{{old('art_title')}}">
                                    @if ($errors->has('art_title'))
                                        <p style="color: red">{{$errors->first('art_title')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">编辑：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="art_editor" name="art_editor" placeholder="小编" value="{{old('art_editor')}}">
                                    @if ($errors->has('art_editor'))
                                        <p style="color: red">{{$errors->first('art_editor')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">略缩图：</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control" id="art_thumb" name="art_thumb" placeholder="略缩图">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">关键词：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="art_tag" name="art_tag" placeholder="美人鱼,周星驰">
                                    @if ($errors->has('art_tag'))
                                        <p style="color: red">{{$errors->first('art_tag')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">描述：</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="art_description" name="art_description" placeholder="描述" value="{{old('art_description')}}"></textarea>
                                    @if ($errors->has('art_description'))
                                        <p style="color: red">{{$errors->first('art_description')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">内容：</label>
                                <!-- 加载编辑器的容器 -->
                                <div class="col-sm-9">
                                    <script id="container" style="height: 600px;" name="art_content" type="text/plain" value="{{old('art_content')}}"></script>
                                    @if ($errors->has('art_content'))
                                        <p style="color: red">{{$errors->first('art_content')}}</p>
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


