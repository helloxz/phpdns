<?php
    define("USER","xiaoz");                 //用户名
    define("PASSWORD","xiaoz.me");  //密码
    define("SALT","phpdns");

    function check_host($host){
        $pattern = '/[a-zA-Z0-9\.-]*[a-zA-Z0-9\.-]+\.[a-zA-Z]+$/';

        if(!preg_match($pattern,$host)){
            echo '不合法的域名';
            exit;
        }
        else{
            return $host;
        }
    }
    //验证IP
    function check_ip($ip){
        if(!filter_var($ip, FILTER_VALIDATE_IP)){
            echo '不是有效的IP!';
            exit;
        }
        else{
            return $ip;
        }
    }
    function userip(){
        if (getenv('HTTP_CLIENT_IP')) { 
        $ip = getenv('HTTP_CLIENT_IP'); 
        } 
        elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
        $ip = getenv('HTTP_X_FORWARDED_FOR'); 
        } 
        elseif (getenv('HTTP_X_FORWARDED')) { 
        $ip = getenv('HTTP_X_FORWARDED'); 
        } 
        elseif (getenv('HTTP_FORWARDED_FOR')) { 
        $ip = getenv('HTTP_FORWARDED_FOR'); 
    
        } 
        elseif (getenv('HTTP_FORWARDED')) { 
        $ip = getenv('HTTP_FORWARDED'); 
        } 
        else { 
        $ip = $_SERVER['REMOTE_ADDR']; 
        } 
        return $ip; 
    }
    //验证状态
    function status(){
        
        //获取IP
        $ip = userip();
        //获取UA
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $info = array(
            "user"      =>  USER,
            "password"  =>  PASSWORD,
            "salt"      =>  SALT
        );

        

        //生成唯一的token
        $token1 = md5($ip.$ua.$info['user'].$info['password'].$info['salt']);
        //获取用户token
        @$token2 = $_COOKIE['token'];
        if($token1 != $token2){
            echo '权限不足';
            setcookie("token", '', time()-3600,'/');
            exit;
        }
    }
    //获取服务器IP
    function serverip(){
        $curl = curl_init("https://ip.awk.sh/api.php?data=ip");

        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36");
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #设置超时时间，最小为1s（可选）
        curl_setopt($curl , CURLOPT_TIMEOUT, 5);

        $html = curl_exec($curl);
        curl_close($curl);
        return $html;
    }
    //获取dnsmasq状态
    function dnscheck($ip){
        
        $url = "https://api.xiaoz.top/tools/TcpCheck.php?port=53&ip=".$ip;

        $url = str_replace("\n","",$url);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)");
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #设置超时时间，最小为1s（可选）
        curl_setopt($curl , CURLOPT_TIMEOUT, 8);

        $html = curl_exec($curl);
        curl_close($curl);
        
        #$html = file_get_contents($url);
        
        #$html = file_get_contents($url);
        $html = json_decode($html);

        #var_dump($html);

        

        

        if($html->msg != 'Openning') {
            $data = array(
                "style"     =>  'layui-icon-close-fill layui-bg-red',
                "msg"       =>  '异常'
            );
            return $data;
            exit;
        }
        else{
            $data = array(
                "style"     =>  'layui-icon-ok-circle layui-bg-green',
                "msg"       =>  '正常'
            );
            return $data;
        }
    }
?>