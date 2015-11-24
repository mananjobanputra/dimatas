<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class activate extends MY_Controller {
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
		if($token){
			$this->load->model("user_model");
			$array = array('type'=>$type);
			$success=false;
			$msg='';
			if($token)
			{
				$where = array('activation_code'=>$token);
				$user_detail = $this->user_model->as_array()->get_by($where);
				if($user_detail){
					$update_array = array('status'=>'a','email_activate'=>'y','activation_code'=>'');
					$temp = $this->user_model->update($user_detail["id"],$update_array,true);
					if($temp){
						$success=true;
						$msg = lang("Account activated successfully.");
					}
				}
			}
			
			if($success==true)
			{
				$this->session->set_flashdata('success',$msg);
				redirect(base_url()."login");
			}
			else{
				$this->session->set_flashdata('404_error',lang("The link you clicked on is invalid or has expired."));
				redirect(base_url()."404");
				exit;
			}
		}
	}
	
}
