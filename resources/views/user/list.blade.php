@extends('layouts.app')

@section('title', '知识库')

@section('style')
    @parent
@endsection

@section('breadcrumb')
    <li navValue="nav_0"><a href="#">管理专区</a></li>
    <li navValue="nav_0_1"><a href="#">账号管理</a></li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
		<section class="panel">
            <div class="panel-body">
            <header class="panel-heading">
                账号列表
            </header>
            	<table class="table table-striped table-hover">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>姓名</th>
                            <th>账号</th>
                            <th>更新时间</th>
                            <th>创建时间</th>
                            <th>操作</th>
		                </tr>
		            </thead>

		            <tbody id="target">
                        @foreach($lists as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td>{{ $list['name'] }}</td>
                            <td>{{ $list['email'] }}</td>
                            <td>{{ $list['updated_at'] }}</td>
                            <td>{{ $list['created_at'] }}</td>
                            <td>
                                <button class="btn btn-info" type="button" onclick="location='{{ route('user_update', ['id' => $list['id'] ]) }}'">编辑</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:if(confirm('确实要删除吗?'))location='{{ route('user_destroy', ['id' => $list['id'] ]) }}'">删除</button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
		        </table>
                @if (can('admin'))
                    {{ $lists->links() }}
                @endif
            </div>
    	</section>
    </div>
</div>
@endsection

@section('script')
    @parent
@endsection
