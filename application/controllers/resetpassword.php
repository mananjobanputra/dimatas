<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class resetpassword extends MY_Controller {
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
	public function index($token)
	{

		if(!$this->input->post()){

			$this->load->model("user_model");
			$where = array('forgotten_password_code'=>$token);
			$user_detail = $this->user_model->as_array()->get_by($where);
			if($user_detail){
				$this->layout 		= 'login_default';
				$this->body_class 	= 	'login';
				$this->load->css('css/login-3.css');
				$this->load->js('js/jquery.prevue.js');
				$this->sections['section_header']='sections/login_section/header';
				$this->sections['section_footer']='sections/login_section/footer';
				$this->sections['register_section'] = 'forgotpassword/index';
				$this->output->set_title(lang("Reset Password"));	
				$this->data['token']=$token;
			}
			else{
				$this->session->set_flashdata('404_error',lang("The link you clicked on is invalid or has expired."));
				redirect(base_url()."404");
			}
		}

		if($this->input->post()){
			$this->load->model("user_model");
			$response = array('status'=>'success','msg'=>'');
			$this->user_model->validate = array(
				array( 'field' => 'password','label' => 'Password','rules' => 'required|min_length[4]|matches[rpassword]'),
				array( 'field' => 'rpassword','label' => 'Confirm Password','rules' => 'required')
				);

			$where = array('forgotten_password_code'=>$token);
			$user_detail = $this->user_model->as_array()->get_by($where);

			if($user_detail){
				$new_pwd = $this->input->post('password');
				$update_array = array('password'=>$new_pwd,'forgotten_password_code'=>'');
				$temp = $this->user_model->update($user_detail["id"],$update_array,true);
				if($temp){
					$this->session->set_flashdata('success',lang("Password reset successfully."));
					redirect(base_url()."login");
				}else{
					$this->session->set_flashdata('error',lang("Password not reset successfully.Please try again."));
					redirect(base_url());
				}
			}else{
				$this->session->set_flashdata('error',lang("The link you clicked on is invalid or has expired."));
				redirect(base_url());
			}
		}		
	}
	
}
