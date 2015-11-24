<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class simplyvulnerablility extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'user';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		$this->sections['section_header'] = 'sections/header';
		$this->sections['section_sidebar'] = 'sections/sidebar';
		$this->sections['section_footer'] = 'sections/footer';
	}
	public function index()
	{
		$this->output->set_title(lang("Simply Port Scan Dashboard"));
		$this->view = 'simplyportscan/index';
	}
	
	public function scans(){
		$this->output->set_title(lang("Manage Scans"));
		$this->load->css('plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');
		$this->load->css('plugins/datatables/plugins/yadcf/jquery.datatables.yadcf.css');
		$deleteurl = base_url().SIMPLY_VULNERABILITY_SCAN."/deletehost";
		$array = array('delete'=>$deleteurl);

		$this->load->js('js/datatable.js');
		$this->load->js('plugins/datatables/jquery.dataTables.min.js');
		$this->load->js('plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
		$this->load->js('plugins/datatables/plugins/responsive/dataTables.responsive.min.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.columnFilter.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.yadcf.js');
		$this->data['tbl_id']		=	'simplyvulnerability_scans';
		$this->data['page_name']		=	'Manage Hosts';
		$this->load->library('Datatables');
		$this->load->helper('datatable_helper');
		
		$this->datatables->select('id,host_id,task_id,status,created_date,updated_date',false)
		->edit_column('host_id', '$1', 'get_vulnerable_hostname(host_id)')
		->edit_column('task_id', '$1', 'get_vulnerable_taskprogress(task_id,status)')
		->edit_column('status', '$1', 'get_vulnerable_status(status")')
		->add_column('operation',get_vulnerable_operation_btn('$1',$array,'$2'),'id,status')
		->where('user_id',$this->user_session["id"])	
		->from('vulnerabilityscan_detail');
		if($this->isAjax){
			$this->layout=false;
			$this->view=false;
			echo $this->datatables->generate();
			exit;
		}
		$results = $this->datatables->generate('raw');
		$this->data['columns'] = $results['columns'];

		$this->load->start_inline_scripting();
		echo "Appp.init_simplyvulnerability_scans;";
		$this->load->end_inline_scripting(false,false);

		$this->view = "layouts/admin/datatable";
	}

	public function add(){
		$this->output->set_title(lang("Add Host"));
		$this->sections['section_header'] = 'sections/admin/header';
		$this->sections['section_sidebar'] = 'sections/admin/sidebar';
		$this->sections['section_footer'] = 'sections/admin/footer';

		$this->data["host_scan_left"] = true;
		$this->data["host_scan_sub_add_host"]=true;
		$this->data["validation_scipt"]=true;

		$this->data["host_h"] = ($this->input->get('h')!='' && strlen($this->input->get('h'))>0)?$this->input->get('h'):'';
		$this->data["h"] = ($this->input->get('h')!='' && strlen($this->input->get('h'))>0)?addScheme($this->input->get('h')):NULL;

		$this->data["host_name"] = NULL;
		$this->data["host_alias"] = NULL;
		$this->data["host_ip"] = NULL;

		if($this->data["h"] != NULL)
		{
			//valid url check
			$this->load->library('Whois');
			$whois = new Whois($this->data["h"]);
			$domain = $whois->domain;
			$hip = gethostbyname($domain);		
			$this->data["host_name"]=$this->data["h"];
			$this->data["host_alias"]=$domain;
			$this->data["host_ip"]=$hip;
			$this->data["user_id"] = $this->user_session["id"];
		}

		$this->view = "simplyportscan/index";			
	}


}
