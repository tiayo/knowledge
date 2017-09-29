@extends('layouts.app')

@section('title', '知识库')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_1"><a href="#">知识专区</a></li>
    <li navValue="nav_1_1"><a href="#">知识库</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">根据栏目查看 <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu">
                        @foreach($categorys as $category)
                            <li><a href="{{ route('knowledge_category', ['category_id' => $category['id']]) }}">{{ $category['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            <header class="panel-heading">
                客户列表
            </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>标题</th>
                            <th>发布人</th>
                            <th>分类</th>
                            <th>更新时间</th>
                            <th>发布时间</th>
                            <th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list['title'] }}</td>
                            <td>{{ $list->users->name }}</td>
                            <td>{{ $list->categories->name }}</td>
                            <td>{{ $list['updated_at'] }}</td>
                            <td>{{ $list['created_at'] }}</td>
                            <td>
                                <button class="btn btn-info" type="button" onclick="window.open('{{ route('knowledge_view', ['id' => $list['id'] ]) }}')">查看</button>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('knowledge_update', ['id' => $list['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('knowledge_destroy', ['id' => $list['id'] ]) }}'">删除</button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>
                {{ $lists->links() }}
            </div>
    	</section>
    </div>
</div>
@endsection

@section('script')
    @parent
@endsection
