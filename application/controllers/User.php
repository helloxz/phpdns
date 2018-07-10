<?php
    class User extends CI_controller{
        public function index(){
            
            $this->load->view('nologin');
            $this->load->view('login');
            $this->load->view('footer');
            //判断用户是否登陆
            if(isset($_COOKIE['token'])){
                header("location:/admin/");
            }


        }
        public function test(){
            $this->load->helper('basis');

            $ip = getip();
            $ua = getua();

            
        }
        public function login(){
            @$user = $this->input->post('user', TRUE);
            @$password = $this->input->post('password',TRUE);
            $this->load->helper('basis');
            $this->load->helper('check');
            //获取IP
            $ip = getip();
            //获取UA
            $ua = getua();
            $info = array(
                "user"      =>  USER,
                "password"  =>  PASSWORD,
                "salt"      =>  SALT
            );

            

            //生成唯一的token
            $token1 = md5($ip.$ua.$info['user'].$info['password'].$info['salt']);
            //生成用户token
            $token2 = md5($ip.$ua.$user.$password.$info['salt']);

            //判断两者是否一致
            if($token1 != $token2){
                $re = array(
                    "code"          =>  0,
                    "msg"           =>  "用户名或密码错误！"  
                );
                $re = json_encode($re);
                echo $re;
                //验证失败，清除cookie并终止执行
                setcookie("token", $token2, time()-3600,'/');
                exit;
            }
            else if($token1 == $token2){
                //$this->load->helper('cookie');
                //生成cookie
                setcookie("token", $token1, time()+3600 * 24 * 7,'/');
                #set_cookie('token',$token1,time()+3600 * 24 * 7);
                $re = array(
                    "code"          =>  1,
                    "msg"           =>  "登录成功！"  
                );
                $re = json_encode($re);
                echo $re;
                exit;
            }
        }  
        
        public function test1(){
            setcookie("abc", 'dsdsd', time()+3600 * 24 * 7);
            #var_dump(set_cookie('test','dsdsd'));
            $c = $_COOKIE['abc'];
            var_dump($c);
            echo $c;
        }
    }
?>