<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'user';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		
	}
	public function index()
	{
		$this->output->set_title(lang("Dashboard"));
		$this->sections['section_header'] = 'sections/header';
		$this->sections['section_sidebar'] = 'sections/sidebar';
		$this->sections['section_footer'] = 'sections/footer';
		$this->view = "dashboard/index";		
	}
	
}
