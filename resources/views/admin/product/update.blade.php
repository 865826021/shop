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
                    <div class="panel-heading"><h3 class="panel-title">产品修改</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/product/update" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">产品类别：</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="cid" name="cid">
                                        @foreach($node as $n)
										    @if($n['cid'] == $article->cid){
												<option value="{{ $n['cid'] }}" selected >{{ $n['name'] }}</option>
											}@else{
												<option value="{{ $n['cid'] }}" >{{ $n['name'] }}</option>
											}
											@endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							
                            <input type="hidden" name="id" value="{{ $article->id }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">文章标题：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
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
                                    <textarea type="text" class="form-control" id="description" name="description">{{ $article->description }}</textarea>
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


