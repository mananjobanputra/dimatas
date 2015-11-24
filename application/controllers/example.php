<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->_init();
	}

	private function _init()
	{
		/*$this->output->set_template('default');*/

		$this->load->css('http://www.grocerycrud.com/assets/ci_simplicity/bootstrap.css');
		$this->load->css('hero_files/bootstrap-responsive.css');
		$this->load->css('css/general.css');
		$this->load->css('css/custom.css');

		$this->load->js('js/jquery-1.9.1.min.js');
		$this->load->js('hero_files/bootstrap-transition.js');
		$this->load->js('hero_files/bootstrap-collapse.js');
	}

	public function index()
	{
		$this->data['test']="manan";
		//$this->json=true;
		//$this->data['test']="manan";
		//$this->data["test_data"]=$this->load->view("example/index",$this->data,true);
		
	}

	public function example_1()
	{
		$this->data['test']="manan";
		$this->view='ci_simplicity/example_1';
	}

	public function example_2()
	{
		$this->layout='simple';
		$this->view='ci_simplicity/example_2';
	}

	public function example_3()
	{
		$this->data['test']="manan";
		$this->sections=array('sidebar'=>'ci_simplicity/sidebar');
		$this->view='ci_simplicity/example_3';
	}

	public function example_4()
	{
		$this->layout=false;
		$this->view='ci_simplicity/example_4';
	}
}
