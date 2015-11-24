<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'both';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		
		if($this->current_login_type == "user")
		{
			$this->sections['section_header'] = 'sections/header';
			$this->sections['section_sidebar'] = 'sections/sidebar';
			$this->sections['section_footer'] = 'sections/footer';
		}	
		else{
			$this->sections['section_header'] = 'sections/admin/header';
			$this->sections['section_sidebar'] = 'sections/admin/sidebar';
			$this->sections['section_footer'] = 'sections/admin/footer';
		}
	}
	public function index()
	{
		$this->main_tab = 'account_setting';
		$this->active_tab 	= 'personal_info';
		$this->load->css('css/profile.min.css');
		$this->output->set_title(lang("Dashboard"));
		
		$this->sections['section_profile_left'] = 'sections/profile/profile_left';
		$this->sections['section_profile_nav_top'] = 'sections/profile/profile_nav_top';
		
		$this->sections['section_profile_content'] = 'account/personal_info';
		

	}

	
	
}
