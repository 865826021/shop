<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{URL::asset('/admin')}}/img/favicon_1.ico">

    <title>后台登陆</title>

    <!-- Google-Fonts -->
    <link href='{{URL::asset('/admin')}}/Css/03a7988f4261455a8379efb98c6852cb.css' rel='stylesheet'>


    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('/admin')}}/Css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('/admin')}}/Css/bootstrap-reset.css" rel="stylesheet">

    <!--Animation css-->
    <link href="{{URL::asset('/admin')}}/Css/animate.css" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="{{URL::asset('/admin')}}/Css/font-awesome.css" rel="stylesheet" />
    <link href="{{URL::asset('/admin')}}/Css/ionicons.min.css" rel="stylesheet" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{URL::asset('/admin')}}/Css/morris.css">


    <!-- Custom styles for this template -->
    <link href="{{URL::asset('/admin')}}/Css/style.css" rel="stylesheet">
    <link href="{{URL::asset('/admin')}}/Css/helper.css" rel="stylesheet">
    <link href="{{URL::asset('/admin')}}/Css/style-responsive.css" rel="stylesheet" />



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{URL::asset('/admin')}}/Scripts/html5shiv.js"></script>
    <script src="{{URL::asset('/admin')}}/Scripts/respond.min.js"></script>
    <![endif]-->

</head>


<body>

<div class="wrapper-page animated fadeInDown">
    <div class="panel panel-color panel-primary">
        <div class="panel-heading">
            <h3 class="text-center m-t-10"> <strong>后台登陆</strong> </h3>
        </div>
        <form class="form-horizontal m-t-40" action="/admin/login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" name="name"  type="text" placeholder="Username">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" name="password" type="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-4">
                    <input class="form-control" name="code" type="text" placeholder="code">
                </div>
                <div class="col-sm-4">
                <a onclick="javascript:re_captcha();" ><img src="{{ URL('/code/captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="35" id="c2c98f0de5a04167a9e427d883690ff6" border="0" ></a>
                @if ($errors->has('code'))
                    <p><a>{{$errors->first('code')}}</a></p>
                @endif
                </div>
            </div>

            <div class="form-group text-right">
                <div class="col-xs-12">
                    <button class="btn btn-purple w-md" type="submit">登陆</button>
                </div>
            </div>

        </form>

    </div>
</div>
<script type="text/javascript">
    function re_captcha(){
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
</script>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{URL::asset('/admin')}}/Scripts/jquery.js"></script>
<script src="{{URL::asset('/admin')}}/Scripts/bootstrap.min.js"></script>
<script src="{{URL::asset('/admin')}}/Scripts/pace.min.js"></script>
<script src="{{URL::asset('/admin')}}/Scripts/wow.min.js"></script>
<script src="{{URL::asset('/admin')}}/Scripts/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{URL::asset('/admin')}}/Scripts/jquery.app.js"></script>
</body>
</html>
