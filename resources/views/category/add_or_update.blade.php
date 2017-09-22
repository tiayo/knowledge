@extends('layouts.app')

@section('title', '添加/修改栏目')

@section('style')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ asset('/style/media/css/jquery.searchableSelect.css') }}">
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理员操作</a></li>
    <li navValue="nav_0_2"><a href="#">栏目管理</a></li>
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
        </div>

        <section class="panel">
            <header class="panel-heading">
                添加/修改栏目
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="salesman_id" value="{{ Auth::id() }}" required>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-sm-2 control-label">分组名称</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="name"
                                   name="name" value="{{ $old_input['name'] }}" placeholder="必须填写" required>
                        </div>
                    </div>
                    <div class="group">
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
    <script src="{{ asset('/style/js/jquery.searchableSelect.js') }}"></script>
    <script>
        $(function(){
            $('#salesman_id').searchableSelect();
        });
    </script>

@endsection
