<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class simplyportscan extends MY_Controller {
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
		$query = $this->db->query("select hs.*,sh.host_alias,sh.host_name,sh.host_ip from host_scans as hs,simplyportscan_hosts as sh where sh.id=hs.host_id and hs.user_id='".$this->current_session["id"]."' group by hs.host_id order by hs.id desc");
		
		$final_array = array();
		$result_array =  $query->result_array();
		$this->data["count"] = count($query->result_array());

		if(!empty($result_array))
		{
			$this->load->model("scan_options_model");
			$this->load->library("nmap");

			foreach ($result_array as $key => $row) {
				/*$post = get_post_from_scan_id($row['id']);*/
				$post = $this->scan_options_model->as_array()->get_many("scan_id",$row['id']);
				$post['ip'] = $row['host_ip'];
				$post['scan_id'] = $row['id'];
				$row["result"] = $this->nmap->get_scan_command($post);   
				if($row['scan_status']=='c'){
					$row["status_cls"] = 'success';
					$row["status"] = 'Completed';
					$row["class"] = 'green-sharp complete';
					$row["icon"] = "icon-arrow-up";
					$row["output"] = "<p>".implode("<br/>",json_decode($row['output']))."</p>";
				}
				else{
					$row["status_cls"] = 'default';
					$row["status"] = 'Pending';
					$row["icon"] = "icon-minus-sign";
					$row["class"] = 'yellow-casablanca scanning';
					$row["output"] ='<div class="loader">Scanning...</div>';
				}
				if(!empty($row["result"]['command'])){
					foreach($row["result"]['command'] as $cd)
					{
						$row["command_text"].="<p>".ucfirst($cd['class'])." : ".$cd["text"]."<p>";
					}
				}

				$final_array[] = $row;
			}


		}
		$this->data["res"] = $final_array;
		/*printr($this->data["res"]);exit;*/

		$this->load->start_inline_scripting();
		echo "Appp.init_portscan_dashboard();";
		$this->load->end_inline_scripting(false,false);

		$this->view = "simplyportscan/dashboard";
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

		$this->data['tbl_id']		=	'simplyportscan_mng_host';
		$this->data['page_name']		=	'Manage Hosts';
		$this->load->library('Datatables');
		$this->load->helper('datatable_helper');
		
		/*$this->datatables->select('id,host_name,host_alias,host_ip,status',false)
		->edit_column('status', '$1', 'get_status(status,id,"manage_agents/change_user_status")')*/

		$this->datatables->select('id,host_name,host_alias,host_ip',false)
		->add_column('operation',get_operation_btn('$1',$array),'id')
		->where('user_id',$this->user_session["id"])		
		->from('simplyportscan_hosts');
		if($this->isAjax){
			$this->layout=false;
			$this->view=false;
			echo $this->datatables->generate();
			exit;
		}
		$results = $this->datatables->generate('raw');
		$this->data['columns'] = $results['columns'];

		$this->load->start_inline_scripting();
		echo "Appp.init_msg_portscan();";
		$this->load->end_inline_scripting(false,false);

		$this->page_name = "Hosts";
		$this->view = "layouts/admin/datatable";
	}

	public function add(){



		if($this->input->post())
		{
			$this->load->model("simplyportscan_hosts_model");
			$host_alias = $this->input->post('alias');
			$host_name = $this->input->post('h');
			$host_ip = $this->input->post('address');
			
			$insert_array = array('user_id'=>$this->current_session["id"],'host_alias'=>$host_alias,'host_name'=>$host_name,'host_ip'=>$host_ip);
			$id = $this->simplyportscan_hosts_model->insert($insert_array,true);
			if($id)
			{
				$this->session->set_flashdata('success',lang("Host added successfully."));
				redirect("simplyportscan/hosts","refresh");
			}

		}
		else if(!$this->input->post())
		{
			$this->output->set_title(lang("Add Host"));

			$this->load->start_inline_scripting();
			echo "Appp.init_hostadd();";
			$this->load->end_inline_scripting(false,false);

			
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
				$temp = $this->load->library('Whois',array($this->data["h"]));
				$hip = gethostbyname($domain);		
				$this->data["host_name"] = $this->data["h"];
				$this->data["host_alias"] = $this->Whois->domain;
				$this->data["host_ip"]= $hip;
				$this->data["user_id"] = $this->user_session["id"];
			}
			$this->view = "simplyportscan/index";
		}
	}

	public function deletehost(){

		if($this->isAjax){
			$this->layout=false;
			$this->view=false;
			$this->json=true;
		}
	}


}
