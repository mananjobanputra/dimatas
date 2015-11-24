<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends My_Model
{
	public $primary_key = 'id';
	public $_table = 'users';
	public $after_create = array( 'after_register' );
	public $before_update = array( 'before_update' );
	public $after_update = array( 'after_update' );
	protected $CI;
	public $validate = array(
		array( 'field' => 'fullname','label' => 'Fullname','rules' => 'required'),
		array( 'field' => 'email','label' => 'Email','rules' => 'trim|required|valid_email|is_unique[users.email]'),
		array( 'field' => 'password','label' => 'Password','rules' => 'trim|required|min_length[4]|matches[rpassword]'),
		array( 'field' => 'rpassword','label' => 'Rpassword','rules' => 'trim|required')
		);
	
	public function __construct()
	{
		parent::__construct();
		$this->current_session=$this->current_session;
		$this->current_login_type=$this->current_login_type;
		$this->CI=& get_instance();
	}
	public function before_update($data){
		if($data["password"] != "")
		{
			$data["password"] = md5($data["password"]);
			
		}
		return $data;
	}
	public function after_update(){
		$array = array('id'=>$this->current_session["id"],'session_update'=>true,'skip_validation'=>true,'type'=>$this->current_login_type);
     	$this->check_login($array);
	}
	public function check_login($array = array('skip_validation'=>false)){
		$response = array('status'=>'success','msg'=>'');
		if($array["skip_validation"] != true)
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() == true)
			{
				$email = $this->input->post("email");
				$password = md5($this->input->post("password"));
				$cond_array = array('email'=>$email,'password'=>$password);
				if($array["type"] == "admin")
				{
					$cond_array["type"] = 'a';
				}
			}
			else{
				$response["status"] = "fail";
				$response["msg"] = validation_errors();
			}
		}

		if($array["session_update"] && $array["session_update"] == true)
		{
			$cond_array = array('id'=>$array["id"]);
		}
		$user_details = $this->as_array()->get_by($cond_array);
		/*echo $this->db->last_query();
		printr($user_details);exit;*/
		if(!empty($user_details) && $user_details["status"] == "a"){
			if($array["type"] && $array["type"] == "admin")
				$sess_nm = ADMIN_SESS_NM;
			else
				$sess_nm = USER_SESS_NM;

			$this->session->set_userdata($sess_nm,$user_details);
			/*printr($this->session->all_userdata());
			echo "z";
			printr($this->current_session);*/
			$this->manage_session();
			/*echo " k ";
			printr($this->current_session);
			exit;*/
			$response["status"] = "success";
			$response["msg"] = lang('Successful login.');			
		}
		else if(empty($user_details)){
			$response["status"] = "fail";
			$response["msg"] = lang("Invalid Email and Password");
		}
		else{
			$response["status"] = "fail";
			$response["msg"] = lang("Not Active user.");
		}
		return $response;
	}	

	protected function after_register($id)
	{
		$user_detail = $this->as_array()->get($id);
		if($user_detail["reg_type"] != 'n')
		{
			$data_mail = array(
				'name'		=>	$user_details["full_name"],
				'email'	=>	$user_detail["email"],
				'password' => $user_detail["password"]			
				);	
			$abc = $this->template->load('/mail/email_template','/mail/social_user_registration',$data_mail,TRUE); 

			send_mail(ADMIN_EMAIL,$user_detail["email"],"Successfull registration :".SITE_NM,$abc);
		}
		else{
			/*Activation login mail*/
			$data_mail = array(
				'name'		=>	$user_details["full_name"],
				'email'	=>	$user_detail["email"],
				'link'	=>	base_url()."activate/".$user_details["activation_code"]
				);	
			$abc = $this->template->load('/mail/email_template','/mail/registration',$data_mail,TRUE); 
			send_mail(ADMIN_EMAIL,$user_details["email"],"Successfull registration :".SITE_NM,$abc);
		}
		$update_array = array('password'=>($user_detail["password"]));
		$this->update($user_detail["id"],$update_array,true);
		return $id;
	}
	public function forgot_password($array = array()){

		$response = array('status'=>'success','msg'=>'');
		$email = $this->input->post('email');
		$forgotten_password_code = md5(time().mt_rand());
		$where = array('email'=>$email);
		$user_detail = $this->as_array()->get_by($where);
		if($user_detail)
		{	
			$update_array = array('forgotten_password_code'=>$forgotten_password_code);
			$temp = $this->update($user_detail["id"],$update_array,true);
			if($temp){
				$response["status"] = "success";
				$response["msg"] = lang('Please check mail for further process.');
				$response["forgotten_password_code"] = $forgotten_password_code;

				$data_mail = array(
					'name'		=>	$user_details["full_name"],
					'email'	=>	$user_detail["email"],
					'code' => $forgotten_password_code,
					'reset_link' => base_url()."resetpassword/".$forgotten_password_code			
					);	
				$abc = $this->template->load('/mail/email_template','/mail/forgot_password',$data_mail,TRUE); 

				send_mail(ADMIN_EMAIL,$user_detail["email"],"Reset Password Link :".SITE_NM,$abc);

			}
		}else{
			$response["status"] = "fail";
			$response["msg"] = 'Invalid email id';
		}
		
		return $response;
	}

	public function manage_session(){
		$user  =   $this->session->userdata(USER_SESS_NM);
		$admin  =   $this->session->userdata(ADMIN_SESS_NM);
		$isadminurl=false;
		if(isset($user) && !empty($user)){
			$this->CI->user_session = $user;
			$this->CI->current_session = $user;
			$this->CI->current_login_type = "user";
		}
		else{
			$this->CI->menutype = 'n';
			$this->CI->current_login_type = "n";   
		}    
		$curl_arr=$this->uri->segment_array();
		$curl_arr=array_filter($curl_arr);
		if(!empty($curl_arr))
		{
			if(in_array("admin",$curl_arr)){
				$isadminurl=true;
			} 
			if($isadminurl && isset($admin) && !empty($admin))
			{
				$this->CI->admin_session = $admin;
				$this->CI->current_session = $admin;
				$this->CI->menutype = 'a';
				$this->CI->current_login_type = "admin";
			}
			
		}
	}
}
