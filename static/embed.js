layui.define(['layer','element','form'], function(exports){
    var layer = layui.layer;
    var element = layui.element;
    var form = layui.form;

    
    
    exports('index', {}); //注意，这里是模块输出的核心，模块名必须和use时的模块名一致
}); 

function login(){
    user = $("#user").val();
    password = $("#password").val();
    
    $.post("/user/login",{user:user,password:password},function(data,status){
        var info = eval('(' + data + ')');

        if(info.code == 1){
            window.location.href = "/admin/";
        }
        else{
            layer.msg(info.msg);
        }
    });
}

//添加主机
function addhost(){
    ip = $("#ip").val();
    domain = $("#domain").val();
    note = $("#note").val();

    $.post("../deal/addhost",{ip:ip,domain:domain,note:note},function(data,status){
        layer.msg(data);
    });
}

//添加去广告
function addad(){
    
    domain = $("#domain").val();
    note = $("#note").val();

    $.post("../deal/addad",{domain:domain,note:note},function(data,status){
        layer.msg(data);
    });
}

//更新数据
function uphost(type,id){
	domain = $("#domain").val();
    note = $("#note").val();
    ip = $("#ip").val();

    $.post("/deal/uphost/" + type + '/' + id,{ip:ip,domain:domain,note:note},function(data,status){
        layer.msg(data);
        setTimeout("window.history.back(-1)", 3000);
    });
}

//删除指定数据
function delate(id,type){
    layer.confirm('确认删除？', {icon: 3, title:'温馨提示！'}, function(index){
        $.get("/deal/delate/" + id + '/' + type,function(data,status){
            var info = eval('(' + data + ')');
            if(info.code == 1){
                layer.msg(info.msg);
                $("#list" + id).remove();
            }
            else{
                layer.msg(info.msg);
            }
        });
    
    layer.close(index);
    });
    
}

//查询IP
function queryip(ip){
    apiurl = "https://ip.awk.sh/api.php?type=json&ip=" + ip;

    $.get(apiurl,function(data,status){
        var info = eval('(' + data + ')');

        if(info.status == 1){
            layer.open({
                title: info.ip
                ,content: info.addr,
                time:3000
            });     
        }
    });
}

//查看备注
function viewnote(id,type){
    $.get("/deal/viewnote/" + id + '/' + type,function(data,status){
        layer.open({
            title:'备注',
            content:data
        });
    });
}
