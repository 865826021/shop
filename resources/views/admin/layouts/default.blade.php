<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="{{URL::asset('/')}}img/favicon_1.ico">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>@section('title') 网站后台 @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here"/>
    @show @section('meta_author')
        <meta name="author" content="Jon Doe"/>
    @show

    @include('admin.public.styles')

        @yield('styles')
</head>


<body>

<!-- Aside Start-->
@include('admin.public.aside')
<!-- Aside Ends-->

<!--Main Content Start -->
<section class="content">

    <!-- Header -->
    @include('admin.public.header')
    <!-- Header Ends -->


    <!-- Page Content Start -->
    <!-- ================== -->

    <div class="wraper container-fluid">
        @yield('content')
    </div>
    <!-- Page Content Ends -->
    <!-- ================== -->

    <!-- Footer Start -->

    @include('admin.public.footer')

    <!-- Footer Ends -->

</section>
<!-- Main Content Ends -->

<!-- js placed at the end of the document so the pages load faster -->
@include('admin.public.script')
@yield('script')


</body>
</html>
