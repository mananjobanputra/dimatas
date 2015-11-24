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
		$this->datatables->select('id,host_name,host_alias,host_ip,status',false)
		->edit_column('status', '$1', 'get_status(status,id,"manage_agents/change_user_status")')
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
		echo "Appp.init_msg_portscan();";
		$this->load->end_inline_scripting(false,false);

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


	public function add_scan(){
		if($this->isAjax){
			$this->layout = false;
			$this->view = false;
			$this->json = true;
			$response["status"] = "success";
			$response["msg"] = "";
			$user_id=$this->current_session["id"];
			$h = $this->input->post("h");
			if($h != "")
			{
				$hid=$h;
				$host_added=true;

				if(!is_numeric($h))
				{
					
					$this->load->library("Whois");
					$whois = new Whois($h);
					$domain=$whois->domain;
					$hip=gethostbyname($domain);	
					$host_name=$h;
					$host_alias=$domain;
					$host_ip=$hip;
					if($host_ip!=''){
						$host_added=true;
						
						$this->load->model("simplyportscan_hosts");
						$array = array('user_id'=>$user_id,'host_alias'=>$host_alias,'host_name'=>$host_name,'host_ip'=>$host_ip);
						$this->simplyportscan_hosts->insert($array,true);
					}
					else{
						$host_added = false;
						$msg = 'Please Enter Host .';
						$final_arr['scan_id'] = NULL;
						$final_arr['host_id'] = NULL;
						$final_arr['content'] = NULL;
					}
				}



				if(is_numeric($hid) && $host_added==true){

					$date=date("Y-m-d H:i:s");
					$this->load->model("host_scans_model");
					$array = array(
						'host_id'=>$hid,
						'user_id'=>$user_id,
						'added_date'=>$date,
						'last_scan_date'=>$date,
						'scan_status'=>'p'
						);

					$scan_id = $this->host_scans_model->insert($array,true);


					$this->load->model("simplyportscan_hosts_model");	
					$where = array("user_id"=>$user_id,'id'=>$hid);
					$data_array = $this->simplyportscan_hosts_model->as_array()->get_by($where);

					$host_exists = $data_array["host_ip"];
					$host_alias = $data_array["host_alias"];

					if($host_exists){
						$post["ip"] = $host_exists;
						$post["scan_id"] = $scan_id;
						$this->load->library("nmap");
						$result = $this->nmap->get_scan_command($post);
						
						if($result['result']=='success'){
							$commands=$result['command'];
							if(!empty($commands))
							{
								$this->load->model("scan_options_model");
								foreach($commands as $com)
								{
									$insert_array = array(
										'scan_id' => $scan_id,
										'option_field' => $com['name'],
										'option_name' => $com['text'],
										'option_value' => $com['value'],
										'option_extra' => $com['extra'],
										'option_extra_value' => $com['extra_value']
									);
									$this->scan_options_model->insert($insert_array,true);
								}
							}	
							
							$success = true;
							$final_arr['scan_id']=$scan_id;
							$final_arr['host_id']=$h;
							$final_arr['host_id']=$hid;
							$status_cls='default';
							$status='Pending';
							$icon="icon-minus-sign";
							$command_text='';
							$class='grey scanning';
							if(!empty($result['command'])){
								foreach($result['command'] as $cd)
								{
									$command_text.="<p>".ucfirst($cd['class'])." : ".$cd["text"]."<p>";
								}
							}
							$content='
							<div class="span12">
								<div class="row-fluid">
									<div class="portlet box '.$class.'">
										<div class="portlet-title">
											<div class="caption"><i class="'.$icon.'"></i>'.$host_alias.'</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>

											</div>
										</div>
										<div class="portlet-body" >

											<h2>'.$host_exists.' <span class="label label-'.$status_cls.' label-mini">'.$status.'</span></h2>
											'.$command_text.'

											<div class="margin-top-10 margin-bottom-10 clearfix"></div>
											<table class="table table-bordered table-striped">
												<tbody>
													<tr>
														<th>
															Output
														</th>
													</tr>
													<tr>
														<td>
															<div class="loader">Scanning...</div>
														</td>
													</tr>
												</tbody></table></div>

											</div>
										</div>';
										$final_arr['content']=$content;

									}
									else{
										$msg='Something went wrong.';
										$final_arr['scan_id']=NULL;
										$final_arr['host_id']=NULL;
										$final_arr['content']=NULL;

									}
								}
								else{
									$msg='Enter valid host.';
									$final_arr['scan_id']=NULL;
									$final_arr['host_id']=NULL;
									$final_arr['content']=NULL;

								}
							}
							else{
								$msg='Enter valid host.';
								$final_arr['scan_id']=NULL;
								$final_arr['host_id']=NULL;
								$final_arr['content']=NULL;
							}
						}

					}else{
						$host_added=false;
						$msg='Enter valid host.';
						$final_arr['scan_id']=NULL;
						$final_arr['host_id']=NULL;
						$final_arr['content']=NULL;
						$response["status"] = "fail";
						$response["msg"] = "Please try again.";
					}
				}
				else{
					redirect("home","refresh");	
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
