@extends('layouts.app')

@section('title', '主页')

@section('style')
    @parent
@endsection

@section('breadcrumb')

@endsection

@section('body')
    <div class="col-md-12 text-center">
        <p><img style="width:400px;margin-top: 3em" src="{{ asset('style/media/image/logo.png') }}" alt=""></p>
        <h4>欢迎您: {{ Auth::user()->name }}</h4>
        <h4>服务器时间: {{ date('Y-m-d H:i:s') }}</h4>
        <h4>登录ip:{{ Request::getClientIp() }}</h4>
    </div>
@endsection

@section('script')
    @parent
@endsection
