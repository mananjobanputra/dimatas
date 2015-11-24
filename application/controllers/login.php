<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'user';
		$this->access   = 'nologin';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		
	}
	public function index($type = null)
	{

		if(!$this->input->post()){
			$this->layout 		= 'login_default';
			$this->output->set_title(lang("Login"));
			$this->body_class = 'login';
			$this->load->css('css/login-3.css');
			$this->load->js('js/jquery.prevue.js');
			$this->access      = 'nologin';
			$this->forgot_url 	=   base_url().'forgotpassword';
			$this->register_url 	=   base_url().'register';
			$this->sections['login_section']='login/index';
			$this->sections['section_header']='sections/login_section/header';
			$this->sections['section_footer']='sections/login_section/footer';
			$action_url=($type=="admin")?base_url()."admin/login":base_url()."login";
			$this->data['type']=($type=="admin")?$type:"user";
			$this->data['action_url']=$action_url;
			$this->load->start_inline_scripting();
			echo "Appp.initLogin();";
			$this->load->end_inline_scripting(false,false);
			$this->view = "login/index";

		}

		if($this->input->post()){
			/*echo $type;*/
			$this->load->model("user_model");
			$array = array('type'=>$type);
			$result = $this->user_model->check_login($array);
			/*var_dump($result);exit;*/
			if($result["status"] == "success")
			{
				
				
				$this->session->set_flashdata('success',$result["msg"]);
				redirect(user_url(true)."dashboard");
			}
			else{
				$this->session->set_flashdata('error',$result["msg"]);
				redirect(user_url(true)."login");
			}
		}
	}
	
}
