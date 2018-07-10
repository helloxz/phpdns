<?php
    class Admin extends CI_controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('check');
            status();
            
        }
        public function index(){
            //设置网页标题
            $data['title']  = '后台管理';
            $data['serverip'] = serverip();
            $dns = dnscheck($data['serverip']);

            $data['style'] = $dns['style'];
            $data['msg'] = $dns['msg'];

            //软连接
            
            $data['ln'] = "ln -s ".APPPATH."conf/hosts.conf /etc/dnsmasq.d/hosts.conf<br />";
            $data['ln'] = $data['ln']."ln -s ".APPPATH."conf/adblock.conf /etc/dnsmasq.d/adblock.conf";
            //$data['code'] = ""
            $this->load->view('header',$data);
            $this->load->view('leftmenu');
            $this->load->view('admin',$data);
            $this->load->view('footer');
        }
        //添加主机
        public function addhost(){
            $data['title']  =   '添加主机';
            $this->load->view('header',$data);
            $this->load->view('leftmenu');
            $this->load->view('addh');
            $this->load->view('footer');
        }
        //添加去广告
        public function addad(){
            $data['title']  =   '去广告';
            $this->load->view('header',$data);
            $this->load->view('leftmenu');
            $this->load->view('adda');
            $this->load->view('footer');
        }
        public function abc(){
            $this->load->helper('check');

            
            check_host("dsds.sdsd.com4");
        }
        //列出所有记录
        public function list($type,$page){
            
            @$page = (int)$page;
            if((!isset($page)) || ($page == '')) {
                $page = 0;
            }
            //获取查询类型
            switch ($type) {
                case 'hosts':
                    $type = 'hosts';
                    $data['title']  = '主机列表';
                    break;
                case 'adblock':
                    $type = 'adblock';
                    $data['title']  = '广告列表';
                    break;
                default:
                    $type = 'hosts';
                    $data['title']  = '主机列表';
                    break;
            }
            //加载数据库类
            $this->load->database();

            //获取数据表总行数
            $num = $this->db->count_all($type);

            //调用分页类
            $this->load->library('pagination');
            $config['base_url'] = "/admin/list/$type/";
            $config['total_rows'] = $num;
            $config['per_page'] = 10;
            $config['first_url'] = 0;
            $config['first_link'] = '首页';
            $config['last_link'] = '尾页';
            
            $this->pagination->initialize($config);

            $data['page'] = $this->pagination->create_links();


            $sql = "SELECT * FROM $type ORDER BY `id` DESC";
            $sql = "select * FROM $type ORDER BY `id` DESC LIMIT 10 OFFSET $page";

            $allinfo = $this->db->query($sql);
            $allinfo = $allinfo->result();

            $data['info'] = $allinfo;
            $data['type'] = $type;

            //调用视图
            $this->load->view('header',$data);
            $this->load->view('leftmenu');
            $this->load->view('list',$data);
            $this->load->view('footer');
            #var_dump($allinfo);
        }
        //退出
        public function logout(){
            //清除cookie并退出
            setcookie("token", '', time()-3600,'/');
            echo 'COOKIES已失效，请重新登录！';
            
            header("Refresh:2;url=/user");
        }
        //查询主机
        public function search($type){
            //获取关键词
            @$keywords = $this->input->get("keywords",TRUE);
            #@$keywords = htmlspecialchars($keywords);
            //判断需要查询的类型
            switch ($type) {
                case 'hosts':
                    $type = 'hosts';
                    $data['title']  = $keywords.'查询结果';
                    break;
                case 'adblock':
                    $type = 'adblock';
                    $data['title']  = $keywords.'查询结果';
                    break;
                default:
                    $type = 'hosts';
                    $data['title']  = $keywords.'查询结果';
                    break;
            }
            

            //关键词模糊查询
            $this->load->database();
            $sql = "SELECT * FROM $type WHERE `domain` LIKE '%$keywords%' ORDER by `id` DESC";
            $query = $this->db->query($sql);

            $data['info'] = $query->result();
            $data['type'] = $type;


            $data['page'] = '';

            //调用视图
            $this->load->view('header',$data);
            $this->load->view('leftmenu');
            $this->load->view('list',$data);
            $this->load->view('footer');
        }
    }

    
?>