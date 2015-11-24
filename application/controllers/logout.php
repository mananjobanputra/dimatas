<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class logout extends MY_Controller {
	function __construct()
	{
		$this->login_type	= '';
		$this->access   = 'login';
		parent::__construct();		
	}
	public function index($type = null)
	{
		$this->load->model("user_model");
		$response = array('status'=>'success','msg'=>'');
		if($type == "admin")
		{
			$redirect_url = base_url()."admin/login";
			$this->session->unset_userdata(ADMIN_SESS_NM);
		}
		else{
			$redirect_url = base_url()."login";
			$this->session->unset_userdata(USER_SESS_NM);
		}
		/*session_destroy();	*/
		$this->session->set_flashdata('success',lang("Successfully loggedout."));
		redirect($redirect_url,"refresh");
		exit;
	}
	
}
