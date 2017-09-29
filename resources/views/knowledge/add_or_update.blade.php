@extends('layouts.app')

@section('title', '添加/修改知识')

@section('style')
    @parent
    {{--编辑器--}}
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/ueditor.all.min.js') }}"> </script>
    <script type="text/javascript" charset="gbk" src="{{ asset('/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">知识专区</a></li>
    <li navValue="nav_1_2"><a href="#">添加/修改知识</a></li>
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
                添加/修改知识
            </header>
            <div class="panel-body">
                <form id="form" class="form-horizontal adminex-form" method="post" action="{{ $url }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="category" class="col-sm-2 col-sm-2 control-label">栏目</label>
                        <div class="col-sm-3">
                            <select class="form-control m-bot15" id="category" name="category_id" required>
                                @if($sign == 'update')
                                    <option value="{{ $old_input['category_id'] }}">{{ $old_input['category_name'] or '' }}</option>
                                @endif

                                @foreach($categorys as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 col-sm-2 control-label">标题</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $old_input['title'] or null}}" placeholder="必须填写" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-2 col-sm-2 control-label">内容</label>
                        <div class="col-md-10">
                            <script id="editor" type="text/plain" name="content">
                                {!! $old_input['content'] or '' !!}
                            </script>
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
    <script>
        $(document).ready(function () {
            $('#password').bind('input propertychange', function() {
                $(this).attr('name', 'password')
            });

            //开启编辑器
            UE.getEditor('editor')
        })
    </script>
@endsection
