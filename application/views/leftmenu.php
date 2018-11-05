<!-- 左侧导航栏 -->
<!-- 内容部分 -->
<div class="layui-container" style = "margin-top:2em;">
    <div class="layui-row">
        <div class="layui-col-lg3">
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="/" layui-this>后台首页</a>
                </li>
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;">添加</a>
                    <dl class="layui-nav-child">
                    <dd><a href="/admin/addhost">hosts</a></dd>
                    <dd><a href="/admin/addad">去广告</a></dd>
                    
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;">hosts列表</a>
                    <dl class="layui-nav-child">
                    <dd><a href="/admin/listrecord/hosts/0">主机列表</a></dd>
                    <dd><a href="/admin/listrecord/adblock/0">广告列表</a></dd>
                    </dl>
                </li>
                <!-- <li class="layui-nav-item layui-nav-itemed">
                    <a href="">系统设置</a>
                </li> -->
                
                <!-- <li class="layui-nav-item"><a href="">大数据</a></li> -->
            </ul>
        </div>
<!-- 左侧导航栏END -->