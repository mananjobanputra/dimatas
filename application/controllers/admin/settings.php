<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'admin';
		$this->access   = '';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		
	}
	public function index()
	{
		$this->load->model("Settings_model");
		if($_POST)
	{
		$field=(isset($_POST["name"]))?$_POST["name"]:"";
		$value=(isset($_POST["value"]))?$_POST["value"]:"";
		$response_arr=array();
		if($field)
		{
			$array = array($field=>$value);
			$this->Site_settings->update('1',$array,true);
			$response_arr['status']='success';
			$response_arr['msg']='';
		}
		else
		{
			$response_arr['status']='failed';
			$response_arr['msg']='Something went wrong. Please try again later.';
		}
		print json_encode($response_arr);
		exit;
	}
		
		$this->page_name = 'Settings';
		$this->load->css('plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css');
		$this->load->js('js/moment.min.js');
		$this->load->js('js/jquery.mockjax.js');
		$this->load->js('plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js');
		$this->load->js('plugins/bootstrap-editable/inputs-ext/address/address.js');
		$this->load->js('plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js');
		$this->load->js('plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js');
		$this->load->js('js/app.min.js');
		/*$this->load->js('js/demo.min.js');*/
		
		$this->load->js('js/form-editable.min.js');
		$this->output->set_title(lang("Dashboard"));
		$this->sections['section_header'] = 'sections/admin/header';
		$this->sections['section_sidebar'] = 'sections/admin/sidebar';
		$this->sections['section_footer'] = 'sections/admin/footer';
		$this->sections['section_profile_left'] = 'sections/profile/profile_left';
			$this->load->start_inline_scripting();
			/*echo 'App.init();';*/
			echo "FormEditable.init();";
			$this->load->end_inline_scripting(false,false);	

			
			$this->setting_data = $this->Settings_model->as_array()->get(1);			
			$this->array_fields=array(
			array("facebook","facebook_link"),
			array("google","google_link"),
			array("youtube","youtube_link"),
			array("twitter","twitter_link"),
			array("github","github_link"),
			array("linkedin","linkedin_link"),
			array("skype","skype_link"),
			array("dribble","dribble_link"),
			array("dropbox","dropbox_link"),
			array("email","email_address"),
			array("phone","phone_number"),
		);
			$this->load->end_inline_scripting(false,false);
		$this->view = "admin/settings/index";

	}
	
}
