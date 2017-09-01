@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="{{URL::asset('/admin')}}/Scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(function (){
            $('input[level=1]').click(function (){
                //alert("7126341732654762");
                var inputs = $(this).parents('.app').find('input');
                //var inputs = $(".app").find('input');
                //$(this).attr('checked') ? inputs.attr('checked','checked') : inputs.removeAttr('checked');
                this.checked ? inputs.prop("checked", true) : inputs.prop("checked", false);
            });
            $('input[level=2]').click(function (){
                var inputs = $(this).parents('dl').find('input');
                this.checked ? inputs.prop("checked", true) : inputs.prop("checked", false);
            });
        });
    </script>
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">配置权限</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">权限列表</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/setAccess" method="post" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <div class="app">
                                    @if(isset($NodeList) && is_array($NodeList))
                                        @foreach($NodeList as $app)
                                            {{ $app['title'] }}
                                                <input type="checkbox" name="access[]" value="{{ $app['id'] }}_1" level="1" @if($app['access'] ==1) checked="checked" @endif/>
                                            @foreach($app['child'] as $action)
                                                <dl>
                                                    <dt>{{ $action['title'] }}
                                                        <input type="checkbox" name="access[]" value="{{ $action['id'] }}_2" level="2" @if($action['access'] ==1) checked="checked" @endif/>
                                                    </dt>
                                                    <dd>
                                                    @foreach($action['child'] as $mothed)
                                                        {{ $mothed['title'] }}<input type="checkbox" name="access[]" value="{{ $mothed['id'] }}_3" level="3" @if($mothed['access'] ==1) checked="checked" @endif/>
                                                    @endforeach
                                                    </dd>
                                                </dl>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="hidden" name="role_id" value="{{ $role_id }}"/>
                                    <button type="submit" class="btn btn-info">保存</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4"></div>
                </div>
            </div>
        </div> <!-- End row -->


    </div>
@endsection