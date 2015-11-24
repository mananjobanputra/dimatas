<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'admin';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		
	}
	public function index()
	{
		$this->load->js('js/app.min.js');
		$this->load->js('js/dashboard.min.js');
		$this->load->js('js/layout.min.js');
		$this->load->js('js/demo.min.js');
		$this->load->js('js/quick-sidebar.min.js');
		$this->output->set_title(lang("Dashboard"));
		$this->sections['section_header'] = 'sections/admin/header';
		$this->sections['section_sidebar'] = 'sections/admin/sidebar';
		$this->sections['section_footer'] = 'sections/admin/footer';
		$this->view = "admin/dashboard/index";		
	}
	
}
