{{--服务注入--}}
@inject('knowledge', '\App\Services\KnowledgeService')
{{--公共赋值--}}
@php
    $count = $knowledge->count(5);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>@yield('title')-{{config('site.title')}}</title>
    @section('style')
        <!--icheck-->
        <link href="{{ asset('/static/adminex/js/iCheck/skins/minimal/minimal.css') }}" rel="stylesheet">
        <link href="{{ asset('/static/adminex/js/iCheck/skins/square/square.css') }}" rel="stylesheet">
        <link href="{{ asset('/static/adminex/js/iCheck/skins/square/red.css') }}" rel="stylesheet">
        <link href="{{ asset('/static/adminex/js/iCheck/skins/square/blue.css') }}" rel="stylesheet">
        <!--common-->
        <link href="{{ asset('/static/adminex/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/static/adminex/css/style-responsive.css') }}" rel="stylesheet">
    @show

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="{{ asset('/static/adminex/js/html5shiv.js') }}"></script>
  <script src="{{ asset('/static/adminex/js/respond.min.js') }}"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <img style="width:200px" src="http://www.startce.com/skin/zd/images/logo_2.png" alt="">
            <a href="/"></a>
        </div>

        <div class="logo-icon text-center">
            <a href="/"></a>
        </div>
        <!--logo and iconic logo end-->
        <div class="left-side-inner">
            @include('layouts.sidebar')
        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">
            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->
            <!--search start-->
            <form class="searchform" id="searchform_id">
                <input type="text" class="form-control" name="keyword" value="{{ Request::route('keyword') }}" placeholder="Search here..." />
            </form>
            <!--search end-->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            当前知识量：
                            <span class="badge">{{ $count }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            当前帐号:
                            {{ Auth::guard()->user()['name'] }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>退出登录</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- header section end-->

        <!--body wrapper start-->
        <div class="wrapper">
            {{--面包屑开始--}}
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb panel">
                        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>主页</a></li>
                        @section('breadcrumb')

                        @show
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            {{--面包屑结束--}}

            @section('body')

            @show
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer style="bottom: 0;position: fixed;">Copyright © 2015 - {{ date('Y') }} startce.OA All Rights Reserved  <strong>v1.0</strong></footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

@section('script')
<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ asset('/static/adminex/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/modernizr.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/jquery.nicescroll.js') }}"></script>

<!--icheck -->
<script src="{{ asset('/static/adminex/js/iCheck/jquery.icheck.js') }}"></script>
<script src="{{ asset('/static/adminex/js/icheck-init.js') }}"></script>

<!--common scripts for all pages-->
<script src="{{ asset('/static/adminex/js/scripts.js') }}"></script>

{{--自动打开菜单层级--}}
<script type="text/javascript">
    $(document).ready(function () {
        var num = $('.breadcrumb li').length;
        for (i=0; i<=num; i++) {
            var nav_value = $('.breadcrumb li:eq('+i+')').attr('navValue');
            $('#'+nav_value).addClass('active nav-active');
        }
    })
</script>

{{--转换搜索链接--}}
<script type="text/javascript">
    $(document).ready(function () {

        $('#searchform_id').submit(function () {

            var key = $(this).find("[name=keyword]");

            var keyword = key.val();

            if (stripscript(keyword) == '') {
                key.val('');
                return false;
            }

            window.location = '{{ route('knowledge_search', ['keyword' => '']) }}/' + stripscript(keyword);

            return false;
        });

    });

    function stripscript(s)
    {
        var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
        var rs = "";
        for (var i = 0; i < s.length; i++) {
            rs = rs+s.substr(i, 1).replace(pattern, '');
        }
        return rs;
    }
</script>
@show
</body>
</html>