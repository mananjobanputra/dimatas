<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'both';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
	}
	private function _init()
	{
		if($this->current_login_type == "admin")
		{
			$this->sections['section_header'] = 'sections/admin/header';
			$this->sections['section_sidebar'] = 'sections/admin/sidebar';
			$this->sections['section_footer'] = 'sections/admin/footer';
		}else{
			$this->sections['section_header'] = 'sections/header';
			$this->sections['section_sidebar'] = 'sections/sidebar';
			$this->sections['section_footer'] = 'sections/footer';
		}
	}
	public function index()
	{
		$this->load->css('css/profile.min.css');
		$this->output->set_title(lang("Dashboard"));
		$this->data["main_tab"]  = 'overview';
		$this->data['tab_caption']="My Profile";
		$this->sections['section_profile_left'] = 'sections/profile/profile_left';
		$this->sections['section_profile_content'] = 'profile/profile_overview';
		$this->view = 'profile/index';
	}
	public function change_password()
	{
		if($this->current_login_type == "" || $this->current_login_type == "n"){
			redirect(base_url(),"refresh");
		}

		if(!$this->input->post()){
			$this->output->set_title(lang("Change Password"));
			$this->access      = 'login';
			if($this->isAjax){
				$this->layout=false;
			}
			$this->data['tab_caption']="Profile Account";
			$this->data['main_tab'] = 'account_setting';
			$this->data['active_tab'] = 'change_password';
			$this->load->css('css/profile.min.css');
			$this->load->js('js/jquery.prevue.js');
			$this->sections['section_profile_left'] = 'sections/profile/profile_left';
			$this->sections['section_profile_nav_top'] = 'sections/profile/profile_nav_top';

			$this->sections['section_profile_change_password'] = 'profile/change_password';
			$this->view = "profile/index";
		}
		else if($this->input->post())
		{
			$array = array();
			$success=false;

			$this->load->model("user_model");

			$this->form_validation->set_rules('old', 'old', 'required');
			$this->form_validation->set_rules('new','new', 'required|min_length[4]|max_length[8]|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'new confirm', 'required');
			if ($this->form_validation->run() == true)
			{
				$password = $this->input->post("new");
				$old = md5($this->input->post("old"));
				
				if($this->current_session["password"] == $old){
					$update_array = array('password'=>$password);
					
					$temp = $this->user_model->update($this->current_session["id"],$update_array,true);
					
					if($temp == true)
					{
						$success=true;
						$msg=lang("Password updated successfully.");
					}
					else{
						$success=false;
						$msg=lang("Please try again.");
					}
				}
				else{
					$success=false;
					$msg=lang("Old password incorrect.");
				}
			}
			else{
				$success=false;	
				$msg = $this->form_validation->error_array();
			}
			if($success==true){
				$this->session->set_flashdata('success',lang("Password updated successfully."));
				redirect(user_url(true)."profile/change_password");
			}
			else{
				$this->session->set_flashdata('error',$msg);
				redirect(user_url(true)."profile/change_password");	
			}
		}
	}
	public function edit()
	{
		$id = $this->current_session["id"];
		
		
		if(!$this->input->post()){
			$this->load->model("user_model");	
			$this->load->model("country_model");
			$this->data["profile_data"] = $this->user_model->as_array()->get($id);
			$cond_array = array('status'=>'y');
			$this->data["country"] = $this->country_model->as_array()->get_many_by($cond_array);
			$this->data['tab_caption']="Profile Account";
			$this->data["main_tab"] = 'account_setting';
			$this->data["active_tab"] 	= 'personal_info';
			$this->load->css('css/profile.min.css');
			$this->output->set_title(lang("Dashboard"));
			$this->sections['section_profile_left'] = 'sections/profile/profile_left';
			$this->sections['section_profile_nav_top'] = 'sections/profile/profile_nav_top';
			$this->sections['section_profile_content'] = 'profile/edit_profile';
			$this->view = "profile/index";
		}

		if($this->input->post()){
			
			$array = array();
			$this->load->model("user_model");

			$this->user_model->validate = array(
				array( 'field' => 'full_name','label' => 'Fullname','rules' => 'required'),
				/*array( 'field' => 'address','label' => 'Address','rules' => 'required'),
				array( 'field' => 'city','label' => 'City','rules' => 'required'),
				array( 'field' => 'state','label' => 'State','rules' => 'required'),
				array( 'field' => 'country','label' => 'Country','rules' => 'required')*/
				);
			$data = array(
				'full_name'=>$this->input->post('full_name'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'country'=>$this->input->post('country')
				);
			$return = $this->user_model->update($id,$data);
			
			if($return==TRUE)
			{
				$this->session->set_flashdata('success',lang("Profile updated successfully.."));
				redirect(user_url(true)."profile/edit");
			}else{
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('error',$errors);
				redirect(user_url(true)."profile/edit");
			}
		}
	}	

}
