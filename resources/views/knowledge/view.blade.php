@extends('layouts.app')

@section('title', '知识库')

@section('style')
    @parent
    <style>
        img{
            max-width: 100% !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">知识专区</a></li>
    <li navValue="nav_1_1"><a href="#">知识库</a></li>
@endsection

@section('body')
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body">
                <div class="blog-post">
                    <h3>最新知识库</h3>
                    @foreach($knowledge_latests as $knowledge_latest)
                        <div class="media">
                            <div class="media-body">
                                <h5 class="media-heading">{{ $knowledge_latest['created_at'] }}</h5>
                                <p>
                                    <a href="{{ route('knowledge_view', ['id' => $knowledge_latest['id']]) }}">
                                        {{ $knowledge_latest['title'] }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <div class="blog-post">
                    <h3>栏目</h3>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('knowledge_category', ['category_id' => $category['id']]) }}">
                                    <i class="  fa fa-angle-right"></i> {{ $category['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <div class="blog-post">
                    <h3>本栏目其他文章</h3>
                    <ul>
                        @foreach($knowledge_currents as $knowledge_current)
                            <li>
                                <a href="{{ route('knowledge_view', ['id' => $knowledge_current['id']]) }}">
                                    <i class="  fa fa-angle-right"></i> {{ $knowledge_current['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="blog">
            <div class="single-blog">
                <div class="panel">
                    <div class="panel-body" id="content">
                        <h1 class="text-center mtop35"><a href="#">{{ $knowledge['title'] }}</a></h1>
                        <p class="text-center auth-row">
                            By <a href="#">{{ $knowledge->users->name }}</a> | Updated {{ $knowledge['updated_at'] }} | Category {{ $knowledge->categories->name }}
                        </p>
                        {!! $knowledge['content'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ asset('/ueditor/ueditor.parse.min.js') }}"></script>
    <script type="text/javascript">
        window.onload=function(){
            uParse('#content', {
                rootPath: '/ueditor'
            });
        };
    </script>
@endsection
