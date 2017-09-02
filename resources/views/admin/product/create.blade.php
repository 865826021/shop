@extends('admin.layouts.default')
@section('content')
    <script type="text/javascript" src="/admin/Scripts/jquery-1.js"></script>
    <script type="text/javascript" src="/admin/Scripts/school.js"></script>
    <script type="text/javascript" src="/admin/Scripts/district.js"></script>

    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">产品管理</h3>
        </div>

        <div class="row">

            <!-- Horizontal form -->
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">产品添加</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/product/store" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">产品类别：</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="cid" name="cid">
                                        @foreach($node as $n)
                                            <option value="{{ $n['cid'] }}">{{ $n['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">产品标题：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="产品标题" value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                        <p style="color: red">{{$errors->first('title')}}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">略缩图：</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control" id="thumb" name="thumb" placeholder="略缩图">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">描述：</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="描述" value="{{old('description')}}"></textarea>
                                    @if ($errors->has('description'))
                                        <p style="color: red">{{$errors->first('description')}}</p>
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


