<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class simplymonitor extends MY_Controller {
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
		$this->output->set_title(lang("Simply Monitor Dashboard"));

		$query = $this->db->query("select hs.*,sh.host_alias,sh.host_name,sh.host_ip from host_scans as hs,simplyportscan_hosts as sh where sh.id=hs.host_id and hs.user_id='".$this->current_session["id"]."' group by hs.host_id order by hs.id desc");
		
		$final_array = array();
		$result_array =  $query->result_array();
		$this->data["count"] = count($query->result_array());
		
		$this->view = 'simplymonitor/index';
	}
	

	public function hosts(){
		$this->output->set_title(lang("Manage Hosts"));
		$this->load->css('plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');
		/*$this->load->css('plugins/datatables/plugins/responsive/responsive.bootstrap.min.css');*/
		$this->load->css('plugins/datatables/plugins/yadcf/jquery.datatables.yadcf.css');
		
		$deleteurl = base_url().SIMPLY_PORT_SCAN."/hosts/deletehost";
		$array = array('delete'=>$deleteurl);


		$this->load->js('js/datatable.js');
		$this->load->js('plugins/datatables/jquery.dataTables.min.js');
		$this->load->js('plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
		$this->load->js('plugins/datatables/plugins/responsive/dataTables.responsive.min.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.columnFilter.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.yadcf.js');

		$this->data['tbl_id']		=	'simplymonitor_mng_host';
		$this->data['page_name']		=	'Manage Hosts';
		$this->load->library('Datatables');
		$this->load->helper('datatable_helper');
		$this->datatables->select('id,host_name,host_alias,host_ip',false)
		->add_column('operation',get_operation_btn('$1',$array),'id')
		->where('user_id',$this->user_session["id"])		
		->from('host_user');
		if($this->isAjax){
			$this->layout=false;
			$this->view=false;
			echo $this->datatables->generate();
			exit;
		}
		$results = $this->datatables->generate('raw');
		$this->data['columns'] = $results['columns'];

		$this->load->start_inline_scripting();
		echo "Appp.init_simplymonitorhosts();";
		$this->load->end_inline_scripting(false,false);

		$this->page_name = "Manage Hosts";
		$this->view = "layouts/admin/datatable";
	}

	public function add(){
		$this->output->set_title(lang("Add Host"));
		$this->view = "simplymonitor/index";			
	}


}
