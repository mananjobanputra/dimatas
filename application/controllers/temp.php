<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class temp extends MY_Controller {
	function __construct()
	{
		$this->login_type	= '';
		$this->access   = '';
		parent::__construct();		
	}
	public function index()
	{
		$data_mail = array(
			'name'		=>	'a',
			'email'	=>	'b',
			'password' => 'x'			
			);	
		$abc = $this->template->load('/mail/email_template','/mail/social_user_registration',$data_mail,TRUE); 

		send_mail(ADMIN_EMAIL,$user_detail["email"],"Successfull registration :".SITE_NM,$abc);
	}
	
}
