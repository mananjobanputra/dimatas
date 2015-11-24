<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class register extends MY_Controller {
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
	public function index()
	{
		if(!$this->input->post()){
			$this->layout 		= 	'login_default';
			$this->body_class 	= 	'login';
			$this->load->css('css/login-3.css');
			$this->load->js('js/jquery.prevue.js');
			$this->sections['section_header']='sections/login_section/header';

			$this->sections['section_footer']='sections/login_section/footer';
			$this->sections['register_section'] = 'register/index';
			$this->load->model("country_model");
			$cond_array = array('status'=>'y');
			$this->data["country"] = $this->country_model->as_array()->get_many_by($cond_array);
			$this->output->set_title(lang("Register"));	
		}
		if($this->input->post()){
			
			$this->load->model("user_model");
			$this->user_model->validate = array(
				array( 'field' => 'fullname','label' => 'Fullname','rules' => 'required'),
				array( 'field' => 'email','label' => 'Email','rules' => 'trim|required|valid_email|is_unique[users.email]'),
				array( 'field' => 'password','label' => 'Password','rules' => 'required|min_length[4]|matches[rpassword]'),
				array( 'field' => 'rpassword','label' => 'Confirm Password','rules' => 'required'),
				/*array( 'field' => 'address','label' => 'Address','rules' => 'required'),
				array( 'field' => 'city','label' => 'City','rules' => 'required'),
				array( 'field' => 'state','label' => 'State','rules' => 'required'),
				array( 'field' => 'country','label' => 'Country','rules' => 'required')*/
				);

			$data = array(
				'full_name'=>$this->input->post('fullname'),
				'email'=>$this->input->post('email'),
				'status'=>'d',				
				'created'=>date('Y-m-d H:i:s'),
				'password'=>$this->input->post('password'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'country'=>$this->input->post('country'),
				'activation_code'=>md5(time().mt_rand())
			);

			$user_id = $this->user_model->insert($data);
			
			if($user_id > 0)
			{
				$this->session->set_flashdata('success',lang("Registered successfully.Please check mail for further process."));
				redirect(base_url());
			}else{
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('error',$errors);
				redirect(base_url()."register");
			}
		}
	}
	
}
