<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>登录-客服知识库</title>

    <link href="{{ asset('static/adminex/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/adminex/css/style-responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/static/adminex/js/html5shiv.js') }}"></script>
    <script src="{{ asset('/static/adminex/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <div class="form-signin" action="index.html">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">客服知识库</h1>
            <img src="/style/media/image/logo.png" width="70%" alt=""/>
        </div>
        <div class="login-wrap">
            <form method="post" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input type="text" class="form-control" placeholder="输入用户名" autofocus name="name" value="{{ session('_old_input')['name'] }}" required>
                <input type="password" class="form-control" placeholder="密码" name="password" required>
                <input class="form-control" type="text" placeholder="验证码" name="code" autocomplete="off" required>
                <img  height="40" style="margin-bottom: 1em;" alt="验证码" title="点击刷新" src="{{ route('captcha', ['group' => 'login']) }}" onclick="javascript:this.src=this.src+'?time='+Math.random()">
                <!--错误输出-->
                <div class="form-group">
                    <div class="alert alert-danger fade in @if(!count($errors) > 0) hidden @endif" id="alert_error">
                        <a href="#" class="close" data-dismiss="alert">×</a>
                        <span>
                            @if ($errors->has('name') || $errors->has('password'))
                                用户名或密码错误！
                            @elseif ($errors->has('code'))
                                验证码错误！
                            @endif
                        </span>
                    </div>
                </div>
                <button class="btn btn-lg btn-login btn-block" type="submit">
                    <i class="fa fa-check"></i>
                </button>
            </form>
            <div class="registration">
                帐号请向管理员申请！
            </div>
        </div>
    </div>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ asset('/static/adminex/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('/static/adminex/js/bootstrap.min.js') }}"></script>
</body>
</html>
