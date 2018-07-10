<div class="layui-col-lg9">
    <!-- 查询按钮 -->
    <form class="layui-form" action="/admin/search/<?php echo $type; ?>/" method = "GET">
    <table class="layui-table layui-form" lay-even="" lay-skin="nob">
        <tbody>
        </tbody><thead>
        <tr>
            <th width="90%">
                <input name = "keywords" type="text" required="" lay-verify="required" placeholder="请输入主机名，支持模糊查询" autocomplete="off" class="layui-input" data-cip-id="url">
            </th>
            <th width="10%"><button type="submit" class="layui-btn layui-btn"><i class="layui-icon"></i> 查 询</button></th>
        </tr>
        </thead>
    </table>
    </form>
    <!-- 查询按钮END -->
    <!-- 表单 -->
    <div class="list">
    <table class="layui-table">
    <colgroup>
        <col width="80">
        <col width="240">
        <col width="150">
        <col width="120">
        <col width="120">
        <col>
    </colgroup>
    <thead>
        <tr>
        <th>ID</th>
        <th>主机</th>
        <th>IP</th>
        <th>添加时间</th>
        <th>备注</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
    <?php foreach ($info as $value) {
        
    ?>
        <tr id = "list<?php echo $value->id; ?>">
        <td><?php echo $value->id; ?></td>
        <td><?php echo $value->domain; ?></td>
        <td><a href="javascript:;" onclick = "queryip('<?php echo $value->ip; ?>')"><?php echo $value->ip; ?></a></td>
        <td><?php echo $value->time; ?></td>
        <td><a href="javascript:;" class="layui-btn layui-btn-xs" onclick = "viewnote('<?php echo $value->id; ?>','<?php echo $type; ?>')">查看备注</a></td>
        <td><a href="javascript:;" class="layui-btn layui-btn-xs layui-btn-danger" onclick = "delate('<?php echo $value->id; ?>','<?php echo $type; ?>')">删除</a></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    </div>
    <!-- 表单END -->
    <!-- 分页按钮 -->
    <div class="page">
        <?php echo $page; ?>
    </div>
    <!-- 分页按钮END -->
</div>
</div>
</div>
<!-- 内容部分END -->