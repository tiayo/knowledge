<!--sidebar nav start-->
<ul style="margin-top:100px;" class="nav nav-pills nav-stacked custom-nav">

    <li class="menu-list" id="nav_0"><a href=""><i class="fa fa-user"></i> <span>管理专区</span></a>
        <ul class="sub-menu-list">
            <li id="nav_0_1"><a href="{{ route('account') }}">账号管理</a></li>
            <li id="nav_0_2"><a href="{{ route('category_list') }}">栏目管理</a></li>
        </ul>
    </li>

    <li class="menu-list" id="nav_1"><a href=""><i class="fa fa-book"></i> <span>知识专区</span></a>
        <ul class="sub-menu-list">
            <li id="nav_1_1"><a href="{{ route('knowledge_list') }}">知识库</a></li>
            <li id="nav_1_2"><a href="{{ route('knowledge_add') }}">添加知识</a></li>
        </ul>
    </li>

</ul>
<!--sidebar nav end-->