        <div class="layui-col-lg9">
            <!-- 内容部分 -->
            <div>
            <span class="layui-breadcrumb" lay-separator="|">
                <a href="/admin/addhost">hosts（添加）</a>
                <a href="/admin/addad">adsense（添加）</a>
                <a href="/admin/list/hosts/0">hosts列表</a>
                <a href="/admin/list/adblock/0">adsense列表</a>
                
            </span>
            </div>
            <hr>
            <!-- 获取IP -->
            <div class = "serverip">
                请将DNS设置为：<code><?php echo $serverip; ?></code>
            </div>
            <hr>
            <!-- DNSMASQ状态 -->
            <div id="dnsmasq">
                DNS状态：<i class="layui-icon <?php echo $style; ?>"></i>  <span><?php echo $msg; ?></span>
            </div>
            <hr>
            <!-- 服务器设置 -->
            <div class = "server">
                <p>请在服务器内执行以下命令建立软连接，并参考 <a href="https://doc.xiaoz.me/docs/phpdns/" target = "_blank">帮助文档</a> 进行配置。</p>
                <p>
                <pre class="layui-code">
<?php echo $ln; ?>
                </pre>   
                </p>
            </div>
            <!-- 内容部分END -->
        </div>
    </div>
</div>
<!-- 内容部分END -->