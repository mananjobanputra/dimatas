<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_users extends MY_Controller {
	function __construct()
	{
		$this->login_type	= 'admin';
		$this->access   = 'login';
		parent::__construct();
		$this->_init();
		$this->load->model("User_model");
		$this->page ='admin/manage_users/';
	}
	private function _init()
	{
		
	}
	public function index()
	{
		/*printr($this->input->get());*/
		
		
		$this->load->css('plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');
		$this->load->css('plugins/datatables/plugins/responsive/responsive.bootstrap.min.css');
		$this->load->css('plugins/datatables/plugins/yadcf/jquery.datatables.yadcf.css');
		$this->load->js('js/datatable.js');
		$this->load->js('plugins/datatables/jquery.dataTables.min.js');
		$this->load->js('plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
		$this->load->js('plugins/datatables/plugins/responsive/dataTables.responsive.min.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.columnFilter.js');
		$this->load->js('plugins/datatables/plugins/yadcf/jquery.dataTables.yadcf.js');

		/*$this->load->js('js/admin/common.js');*/
		$this->page_name = lang("Manage Users");
		$this->output->set_title(lang("Manage Users"));
		$this->data['page_url']	=	'manage_users';
		$this->data['add_button'] = true;
		$this->data['add_button_href'] = $this->data['page_url'].'/add';
		$this->data['tbl_id']		=	'tblmng_users';
		$this->sections['section_header'] = 'sections/admin/header';
		$this->sections['section_sidebar'] = 'sections/admin/sidebar';
		$this->sections['section_footer'] = 'sections/admin/footer';
		$this->load->start_inline_scripting();
		echo "Appad.init_mng_users();";
		$this->load->end_inline_scripting(false,false);
		$this->view = "layouts/admin/datatable";		
		$editurl = base_url()."admin/manage_users/edit";
		$deleteurl = base_url()."admin/manage_users/delete";
		$array = array('edit'=>$editurl,'delete'=>$deleteurl);
		$edit_del_url 	= $this->model_url;
		$controllerFuncName	=	'edit';
		$this->load->library('Datatables');
		$this->load->helper('datatable_helper');
		$this->datatables->select('id,full_name,email,status',false)
		->edit_column('status', '$1', 'get_status(status,id,"manage_users/change_user_status")')
		->add_column('operation',get_operation_btn('$1',$array),'id')	
		/*->add_column('operation','$1','car_btn(id)')*/
		/*->unset_column('id')*/
		->where('type !=','a')
		->from('users');
		if($this->isAjax){
			$this->layout=false;
			$this->view=false;
			echo $this->datatables->generate();
			exit;
		}
		$results = $this->datatables->generate('raw');
		$this->data['columns'] = $results['columns'];		
	}
	public function isUniqueEmail(){
		/*printr($this->input->get());*/
		$this->layout=false;
		$this->view=false;
		$email = $this->input->get('email');
		if($email != ''){
			$this->User_data = $this->User_model->set_fields("id,status")->as_array()->get_by('email',$email);
			if(!empty($this->User_data)){
				echo 'false';
			}else{
				echo 'true';
			}
		}else{
			echo 'false';
		}
		exit;	
	}

	public function change_status(){
		$this->layout=false;
		$this->view=false;
		$this->json=true;		
		$uid = $this->input->post('uid');
		$upd_status = 'd';
		if($uid > 0 ){
			$this->User_data = $this->User_model->set_fields("id,status")->as_array()->get($uid);
			//printr($this->User_data);	
			if($this->User_data['status'] == 'd'){
				$upd_status = 'a';
			}
			/* change status update value in database code start */
			$update_array = array('status' => $upd_status);
			$response = $this->User_model->update($uid,$update_array,true);	
			$this->data["status"] = "success";
			$this->data["msg"] = "";	
			/* end of the change status update value in database code*/
		}
	}

	/* add edit new user code start */

	public function add_edit_user($id=NULL){
		$this->load->model("country_model");
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		/* edit code start */

		if($id != NULL && $id > 0){
			if($this->input->post()){
				$this->form_validation->set_rules('full_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
				$this->form_validation->set_rules('address', $this->lang->line('edit_user_validation_lname_label'), 'required');
				$this->form_validation->set_rules('city', $this->lang->line('edit_user_validation_lname_label'), 'required');
				if ($this->form_validation->run() === TRUE){
					$data = array(
						'full_name' => $this->input->post('full_name'),
						'country' => $this->input->post('country'),
						'city' => $this->input->post('city'),
						'address' =>  $this->input->post('address')
						);
					if($this->ion_auth->update($id, $data))
					{
						$this->session->set_flashdata('success', $this->ion_auth->messages());
						redirect(user_url(true)."manage_users", 'refresh');    				
					}else{
						
						$this->session->set_flashdata('error', $this->ion_auth->errors());
						if ($this->ion_auth->is_admin())
						{
							redirect('auth', 'refresh');
						}
						else
						{
							redirect('/', 'refresh');
						}
					}
				}else{
					$this->session->set_flashdata('error',validation_errors());
				}


			}

			$this->page_type = 'edit';
			$this->load->model("country_model");
			$this->data["profile_data"] = $this->User_model->as_array()->get($id);
			$cond_array = array('status'=>'y');
			$this->data["country"] = $this->country_model->as_array()->get($id);
			$this->page_name = lang("Edit Users");
			$this->output->set_title(lang("Edit Users"));
			$this->data['page_url']				=	'manage_users/edit';
			$this->from_url = base_url().'admin/manage_users/edit/'.$id;	
			$this->sections['section_header'] 	= 'sections/admin/header';
			$this->sections['section_sidebar'] = 'sections/admin/sidebar';
			$this->sections['section_footer'] = 'sections/admin/footer';
			$this->load->start_inline_scripting();
			echo "Appad.init_add_edit_users();";
			echo " var isEmailReq = false;";
			$this->load->end_inline_scripting(false,false);
			$cond_array = array('status'=>'y');
			$this->data["country"] = $this->country_model->as_array()->get_many_by($cond_array);
			$this->view = $this->page."add_edit";

		}
		/* end of the edit code */

		/* add code start */

		elseif($this->input->post()){
			$tables = $this->config->item('tables','ion_auth');
			$identity_column = $this->config->item('identity','ion_auth');
			$this->data['identity_column'] = $identity_column;
			$this->form_validation->set_rules('full_name', $this->lang->line('create_user_validation_fname_label'), 'required');

			if($identity_column !== 'email'){
				$this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
				$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
			}
			else
			{
				$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
			}
			$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[rpassword]');
			$this->form_validation->set_rules('rpassword', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
			if ($this->form_validation->run() == true)
			{
				$email    = strtolower($this->input->post('email'));
				$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
				$password = $this->input->post('password');
				$additional_data = array(
					'full_name'		=>	$this->input->post('full_name'),
					'address' 		=>	$this->input->post('address'),
					'country'  		=>	$this->input->post('country'),
					'city' 			=>	$this->input->post('city'),
					'type' 			=>	'u',
					'status'		=>	'a',
					'email_activate'=>	'a'
					);        		
			}if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data,true)){

				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect(base_url()."admin/manage_users", 'refresh');
			}else{

				$this->session->set_flashdata('error', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));	
				redirect(base_url()."admin/manage_users/add", 'refresh');
			}
		}else{
			$this->page_type = 'add';
			$this->page_name = lang("Add Users");
			$this->output->set_title(lang("Add Users"));
			$this->data['page_url']				=	'manage_users/add';
			$this->from_url = base_url().'admin/manage_users/add';	
			$this->sections['section_header'] 	= 'sections/admin/header';
			$this->sections['section_sidebar'] = 'sections/admin/sidebar';
			$this->sections['section_footer'] = 'sections/admin/footer';
			$this->load->start_inline_scripting();
			echo "Appad.init_add_edit_users();";
			echo " var isEmailReq = true;";
			$this->load->end_inline_scripting(false,false);
			$cond_array = array('status'=>'y');
			$this->data["country"] = $this->country_model->as_array()->get_many_by($cond_array);
			$this->view = $this->page."add_edit";
		}
		/* end of the add code */
	}

	/* end of the add edit user code */

	/* delete user code start */

	public function delete($id){
		if($id > 0){
			$this->User_model->delete($id);
			$this->session->set_flashdata('success',lang('User deleted  successfully.'));
			redirect(user_url(true)."manage_users");
		}
		
		$this->session->set_flashdata('error',lang('Invalid id.'));
		redirect(user_url(true)."manage_users");
	}
	/* end of the delete user code */

}
