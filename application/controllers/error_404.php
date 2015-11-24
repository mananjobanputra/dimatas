<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class error_404 extends MY_Controller {

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
		$this->layout='error';
		$this->output->set_title(lang("404"));	
		$msg_404error = $this->session->flashdata('404_error');
		$this->data['message_text']='';
		if($msg_404error!=''){
			
			if(!empty($msg_404error) && is_array($msg_404error))
			{
				foreach ($msg_404error as $key => $value) {
					$this->data['message_text'] .= $value."<br />";
				}
			}
			else{
				$this->data['message_text'] = $msg_404error;
			}
		}
		else{
			$this->data['message_text']=lang("We can not find the page you're looking for.");
		}
	}
	public function index(){

		$this->load->css('css/error.css');
	}

}
