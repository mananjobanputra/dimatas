<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class forgotpassword extends MY_Controller {
	function __construct()
	{
		$this->login_type	= '';
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
			$this->body_class 	= 	'login';
			$this->load->css('css/login-3.css');
			$this->load->js('js/jquery.prevue.js');
			$this->sections['section_header']='sections/login_section/header';
			$this->sections['section_footer']='sections/login_section/footer';
			$this->sections['register_section'] = 'forgotpassword/index';
			$action_url=($type=="admin")?base_url()."admin/forgotpassword":base_url()."forgotpassword";
			$login_url=($type=="admin")?base_url()."admin/login":base_url()."login";
			$this->data['action_url']=$action_url;
			$this->data['login_url']=$login_url;
			$this->output->set_title(lang("Forgot Password"));	
		}

		if($this->input->post()){
			$this->load->model("user_model");

			$this->user_model->validate = array(
				array( 'field' => 'email','label' => 'Email','rules' => 'required|valid_email')
				);
			$result = $this->user_model->forgot_password();


			if($result["status"] == "success")
			{
				$this->session->set_flashdata('success',$result["msg"]);
				redirect(base_url()."login");
			}
			else{
				$this->session->set_flashdata('error',$result["msg"]);
				redirect(base_url()."forgotpassword");
			}

		}		
	}
	
}
