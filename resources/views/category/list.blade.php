@extends('layouts.app')

@section('title', '业务员分组')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理员专区</a></li>
    <li navValue="nav_0_2"><a href="#">栏目管理</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
                <button type="button" class="btn btn-primary" onclick="location='{{ route('category_add') }}'">添加栏目</button>
                <header class="panel-heading">
                    客户列表
                </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>栏目名</th>
                            <th>添加用户</th>
                            <th>创建时间</th>
							<th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($categorys as $category)
                        <tr>
                            <td>{{ $category['id'] }}</td>
                            <td>{{ $category['name'] }}</td>
                            <td>{{ $category['user_name'] }}</td>
                            <td>{{ $category['created_at'] }}</td>
                            <td>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('category_update', ['id' => $category['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('category_destroy', ['id' => $category['id'] ]) }}'">删除</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>
                {{ $categorys->links() }}
            </div>
    	</section>
    </div>
</div>
@endsection

@section('script')
    @parent
@endsection
