<?php
    class Deal extends CI_controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('check');
            status();
            
        }
        //添加主机
        public function addhost(){
            //获取主机并验证
            $domain = $this->input->post('domain',TRUE);
            $domain = check_host($domain);
            //获取IP并验证
            $ip = $this->input->post('ip',TRUE);
            $ip = check_ip($ip);
            

            //获取备注
            $note = $this->input->post('note',TRUE);

            $time = date('Y-m-d',time());

            //加载数据库类
            $this->load->database();
            //验证主机名
            $this->checkhost($domain,'hosts');
            $data = array(
                'ip'        =>  $ip,
                'domain'    =>  $domain,
                'note'      =>  $note,
                'time'      =>  $time
            );

            //插入数据
            $insert = $this->db->insert('hosts', $data);

            //如果数据插入成功
            if($insert){
                echo '添加成功！';
                $this->writeconf('hosts');
            }
            else{
                echo '写入失败！';
                exit;
            }
        }
        //添加去广告
        //添加主机
        public function addad(){
            //获取主机并验证
            $domain = $this->input->post('domain',TRUE);
            $domain = check_host($domain);
            //获取IP并验证
            #$ip = $this->input->post('ip',TRUE);
            $ip = '127.0.0.1';
            

            //获取备注
            $note = $this->input->post('note',TRUE);

            $time = date('Y-m-d',time());

            //加载数据库类
            $this->load->database();
            //验证主机名
            $this->checkhost($domain,'adblock');
            $data = array(
                'ip'        =>  $ip,
                'domain'    =>  $domain,
                'note'      =>  $note,
                'time'      =>  $time
            );

            //插入数据
            $insert = $this->db->insert('adblock', $data);

            //如果数据插入成功
            if($insert){
                echo '添加成功！';
                $this->writeconf('adblock');
            }
            else{
                echo '写入失败！';
                exit;
            }
        }
        //写入配置文件
        public function writeconf($type){
            $this->load->database();
            
            switch ($type) {
                case 'hosts':
                    $confpath = APPPATH."conf/hosts.conf";
                    $sql = "SELECT `id`,`ip`,`domain` FROM 'hosts'";
                    break;
                case 'adblock':
                $confpath = APPPATH."conf/adblock.conf";
                    $sql = "SELECT `id`,`ip`,`domain` FROM 'adblock'";
                    break;
                default:
                    # code...
                    break;
            }
            
            $query = $this->db->query($sql);
            $content = '';
            #var_dump($content->result());
            foreach ($query->result() as $row) {
                #echo $row->ip;
                #$content = $content.$content;
                $row = "address=/".$row->domain."/".$row->ip."\n";
                $content = $row.$content;
                
                
            }
            $myfile = fopen($confpath, "w") or die("Unable to open file!");
            fwrite($myfile, $content);
            
            
            fclose($myfile);
        }
        //检查是否存在相同主机
        public function checkhost($domain,$type){
            $query = $this->db->query("SELECT * FROM $type WHERE `domain` = '$domain'");
            
            //返回影响函数
            $num = $query->num_rows();
          
            #echo 'dsd';
            
            if($num >= 1){
                echo '已存在相同主机名！';
                exit;
            }

            
        }
        public function test1(){
            $query = $this->load->database();
            

            $this->checkhost('xiaoz.me');
            
        }
        //删除某个主机
        public function delate($id,$type){
            $id = (int)$id;

            //判断类型
            switch ($type) {
                case 'hosts':
                    $type = 'hosts';
                    break;
                case 'adblock':
                    $type = 'adblock';
                    break;
                default:
                    $type = 'hosts';
                    break;
            }
            
            $sql = "DELETE FROM `$type` WHERE `id` = $id";
            $this->load->database();
            $query = $this->db->query($sql);

            if($query){
                $reinfo = array(
                    "code"      =>  1,
                    "msg"       =>  '已删除'
                );
                $reinfo = json_encode($reinfo);
                echo $reinfo;
                $this->writeconf($type);
                exit;
            }
            else{
                $reinfo = array(
                    "code"      =>  0,
                    "msg"       =>  '删除失败！'
                );
                $reinfo = json_encode($reinfo);
                echo $reinfo;
                exit;
            }
        }
        //查看备注
        public function viewnote($id,$type){
            $id = (int)$id;
            //判断类型
            switch ($type) {
                case 'hosts':
                    $type = 'hosts';
                    break;
                case 'adblock':
                    $type = 'adblock';
                    break;
                default:
                    $type = 'hosts';
                    break;
            }

            $sql = "SELECT `note` FROM `$type` WHERE `id` = $id";
            $this->load->database();
            $query = $this->db->query($sql);
            $note = $query->result();
            echo $note[0]->note;
        }
    }
    
?>