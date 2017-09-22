@extends('layouts.app')

@section('title', '添加/管理业务员')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_1"><a href="#">账号管理</a></li>
@endsection

@section('body')
    <div class="col-md-12">

        <!--错误输出-->
        <div class="form-group">
            <div class="alert alert-danger fade in @if(!count($errors) > 0) hidden @endif" id="alert_error">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <span>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </span>
            </div>
            <div class="alert
                @if(session('result') == 'succeed')
                    alert-success
                @elseif(session('result') == 'failed')
                    alert-danger
                @endif
                    fade in
                @if(!Request::session()->has('result'))
                        hidden
                @endif" id="alert_error">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <span>
                    @if(session('result') == 'succeed')
                        更新成功！
                        @elseif(session('result') == 'failed')
                        更新失败
                    @endif
                </span>
            </div>
        </div>

        <section class="panel">
            <header class="panel-heading">
                账号管理
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ route('account') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">用户名</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $old_input['name'] }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-3">
                            <input type="email" id="old_email" name="email" class="hidden" disabled>
                            <input type="email" class="form-control" id="email" name="email" autoComplete="off" value="{{ $old_input['email'] or null}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 col-sm-2 control-label">密码</label>
                        <div class="col-sm-3">
                            <input type="password" id="old_password" name="password" class="hidden" disabled>
                            <input type="password" class="form-control" id="password" autoComplete="off" placeholder="放空则不做修改">
                        </div>
                    </div>
                    <div class="form-group">
                        <div  class="col-sm-2 col-sm-2 control-label">
                            <button class="btn btn-success" type="submit"><i class="fa fa-cloud-upload"></i> 确认提交</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $('#password').bind('input propertychange', function() {
                $(this).attr('name', 'password')
            })
        })
    </script>
@endsection
