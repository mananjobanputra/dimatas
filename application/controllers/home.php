<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{	
		$this->login_type	='';
		$this->layout		='';
		$this->access      ='';
		parent::__construct();
		$this->_init();
	}

	private function _init()
	{
		/*$this->load->css('css/fullscreen-slider.css');*/
		/* end of add js and css */
		$this->layout='home';
	}

	public function index()
	{
		$this->output->set_title(lang("Home"));	
		/*$this->sections['section_header']='sections/home_section/header';
		$this->sections['section_slider']='sections/home_section/slider';
		$this->sections['section_search']='sections/home_section/search';
		$this->sections['section_footer']='sections/home_section/footer';*/
		/*$this->load->start_inline_scripting();
		echo "App.initHome();";
		$this->load->end_inline_scripting(false,false);*/
		/*$this->body_class = "nav-menu-no-padding bg-black-loading";*/
	}
}
