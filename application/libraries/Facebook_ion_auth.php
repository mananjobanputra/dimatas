<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Facebook_ion_auth {
	/*
		Library for login with facebook and create a ion_auth compatibility session. 
		author: Daniel Georgiev
		website: http://dgeorgiev.biz
	*/
		public function __construct() {
		// get Codeigniter instance
			$this->CI =& get_instance();
	    // Load config
			$this->CI->load->config('facebook_ion_auth', TRUE);
			$this->app_id = $this->CI->config->item('app_id', 'facebook_ion_auth');
			$this->app_secret = $this->CI->config->item('app_secret', 'facebook_ion_auth'); 
			$this->scope = $this->CI->config->item('scope', 'facebook_ion_auth');

			if($this->CI->config->item('redirect_uri', 'facebook_ion_auth') === '' ) {
				$this->my_url = site_url(''); 
			} else {
				$this->my_url = $this->CI->config->item('redirect_uri', 'facebook_ion_auth');
			}

		}
		public function login($user_data = NULL) {
			$this->CI->load->model("ion_auth_model");	
			$code = $this->CI->input->get('code');
			/*if is not set go make a facebook connection*/
			if(!$code && $user_data == NULL) {
				/*create a unique state*/
				$this->CI->session->set_userdata('state', md5(uniqid(rand(), TRUE)));
	   			/*redirect to facebook oauth page*/
				$url_to_redirect =  "https://www.facebook.com/dialog/oauth?client_id=".$this->app_id."&redirect_uri=".urlencode($this->my_url)
				."&state=".$this->CI->session->userdata('state').'&scope='.$this->scope;
				redirect($url_to_redirect);

			} elseif(isset($user_data) && $user_data != NULL){
				/* check if this user is already registered*/
				$user = $user_data;
				if(!$this->CI->ion_auth_model->identity_check($user['email'])){
					$this->CI->load->helper('string');
					$password = random_string('alnum', 6);
					
					$register = $this->CI->ion_auth->register($user['email'],$password, $user['email'], array('firstname' => $user['first_name'], 'lastname' => $user['last_name'],'status'=>'a','google_id'=>$user['uid'],'display_google_image'=>'y'),NULL,true);

					$data_mail = array('name'	    =>	$user['first_name'],
										'title'		=>	'Login Detail',
										'email'		=>	$user['email'],
										'password'  => $password);	
					$abc = $this->CI->template->load('/mail/email_template','/mail/social_user_registration',$data_mail,TRUE); 
					send_mail(ADMIN_EMAIL,$user['email'],"Login Credential :".SITE_NM,$abc);	

					$login = $this->CI->ion_auth->login($user['email'],NULL,NULL,array(),true);
				}else{

					$data = social_get_user_detail($user['email'],'id,google_id');
					/*echo $this->CI->db->last_query();*/

					if(!empty($data)){
						if($data->google_id == '' || $data->google_id == NULL){
							$updData = array(
								'google_id'=>$user['uid'],
								'display_fb_image'=>'n',
								'display_google_image'=>'y'
								);
							$this->CI->db->where('id',$data->id);
							$this->CI->db->update('users',$updData);
						}
					}


					$login = $this->CI->ion_auth->login($user['email'],NULL,NULL,array(),true);
				}


			}else{
	   		/* check if session state is equal to the returned state*/
				if($this->CI->session->userdata('state') && ($this->CI->session->userdata('state') === $this->CI->input->get('state'))) {
					$token_url = "https://graph.facebook.com/oauth/access_token?"
					. "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
					. "&client_secret=" . $this->app_secret . "&code=" . $code;
					$response = file_get_contents($token_url);

					$params = null;
					parse_str($response, $params);
					$this->CI->session->set_userdata('access_token', $params['access_token']);
					/*echo $graph_url;*/
					$graph_url = "https://graph.facebook.com/me?fields=id,name,email,first_name,last_name,photos&access_token=".$params['access_token'];

					$user = json_decode(file_get_contents($graph_url));
					
				/* check if this user is already registered*/
					if(!$this->CI->ion_auth_model->identity_check($user->email)){

						$this->CI->load->helper('string');
						$password = random_string('alnum', 6);

						$register = $this->CI->ion_auth->register($user->email,$password, $user->email, array('firstname' => $user->first_name, 'lastname' => $user->last_name,'status'=>'a','fb_id'=>$user->id,'display_fb_image'=>'y'),NULL,true);

						
						/* credential mail code */
						$data_mail = array(
						'name'		=>	$user->first_name,
						'title'		=>	'Login Detail',
						'email'		=>	$user->email,
						'password'  => $password);	

						/*printr($data_mail);
						exit;*/

					$abc = $this->CI->template->load('/mail/email_template','/mail/social_user_registration',$data_mail,TRUE); 

					/*echo $abc;*/
					send_mail(ADMIN_EMAIL,$user->email,"Login Credential :".SITE_NM,$abc);	
				/*	print_r($abc);*/
					$login = $this->CI->ion_auth->login($user->email,NULL,NULL,array(),true);
					/* end of the credential mail code */
					/*exit;*/
					

					}else{
						/*echo "inn";*/
						$data = social_get_user_detail($user->email,'id,fb_id');
						if(!empty($data)){
							if($data->fb_id == '' || $data->fb_id == NULL){
								$updData = array('fb_id'    =>	$user->id,
									'display_fb_image'		=>	'y',
									'display_google_image'	=>	'n');
								$this->CI->db->where('id',$data->id);
								$this->CI->db->update('users',$updData);
							}
						}

						$login = $this->CI->ion_auth->login($user->email,NULL,NULL,array(),true);


					}
					
					return true;
				}
				else {
					return false;
				}
			}
		}
	}
/* End of file Facebook_ion_auth.php */