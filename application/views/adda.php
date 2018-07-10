<div class="layui-col-lg9">
            <!-- 表单 -->
            <div>
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">主机/域名</label>
                    <div class="layui-input-block">
                    <input type="text" id = "domain" required  lay-verify="required" placeholder="请输入主机/域名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                    <textarea id = "note" name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
                
                </form>
            </div>
            <!-- 表单END -->
            <div class="layui-form-item">
                <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" onclick = "addad()">添加</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
            <!-- 使用说明 -->
            <div class="use">
            <blockquote class="layui-elem-quote layui-quote-nm">
                <ol>
                    <li>1. 主机名格式如：eclick.baidu.com</li>
                    <li>2. 如果需要支持泛域名填写：baidu.com</li>
                    <li>3. 去广告原理是将指定域名解析到127.0.0.1，一旦添加后将无法再访问该网站</li>
                </ol>
            </blockquote>
                
            </div>
            <!-- 使用说明END --> 
        </div>
    </div>
</div>
<!-- 内容部分END -->